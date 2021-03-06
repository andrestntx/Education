<?php

namespace Education\Http\Controllers\Dashboard\Checklists;

use Illuminate\Routing\Route;
use Education\Http\Controllers\Controller;
use Education\Entities\Format;
use Education\Entities\Checklist;
use Education\Http\Requests\Checklists\CreateRequest;
use Auth;
use Flash;
use App;

class ChecklistsController extends Controller
{
    private $format;
    private $checklist;

    private static $prefixRoute = 'myformats.checklists.doit.';
    private static $prefixView = 'dashboard.pages.companies.users.formats.checklists.';

    public function __construct()
    {
        $this->beforeFilter('@findFormat', ['except' => ['allMyFormats']]);
        $this->beforeFilter('@validateChecklist', ['only' => ['create']]);
        $this->beforeFilter('@newChecklist', ['only' => ['create', 'store']]);
        $this->beforeFilter('@findChecklist', ['only' => ['show', 'download']]);
        $this->beforeFilter('@loadQuestions', ['only' => ['create']]);
    }

    /**
     * Find the Format or App Abort 404.
     */
    public function findFormat(Route $route)
    {
        $this->format = Format::findOrFail($route->getParameter('checklists'));
    }

    public function loadQuestions()
    {
        $this->format->load(['questions' => function ($query) {
            $query->orderBy('order', 'asc');
        }]);
    }

    /**
     * Validate the conditions for a new Checklist.
     */
    public function validateChecklist()
    {
        if (!$this->format->isAviable()) {
            Flash::warning('El formato no está habilitado');

            return redirect()->route('checklists.doit.index', $this->format);
        }
    }

    /**
     * Create a new Checklist.
     */
    public function newChecklist()
    {
        $this->checklist = new Checklist();
    }

    /**
     * Find the Checklist or App Abort 404.
     */
    public function findChecklist(Route $route)
    {
        $this->checklist = Checklist::findOrFail($route->getParameter('doit'));
        $this->checklist->load('answers.question');

        $this->checklist->answers = $this->checklist->answers->sortBy(function ($answer, $key) {
            return $answer->question->order;
        });
    }

    public function allMyFormats()
    {
        return view(self::$prefixView . 'format.myformats');
    }

    public function index($format_id)
    {
        $checklists = $this->format->getUserChecklists(Auth::user());

        return view(self::$prefixView.'list')
            ->with(['checklists' => $checklists, 'format' => $this->format]);
    }

    public function create($format_id)
    {

        $form_data = ['route' => ['myformats.checklists.doit.store', $this->format], 'method' => 'POST'];

        return view(self::$prefixView.'form', compact('form_data'))
            ->with(['checklist' => $this->checklist, 'format' => $this->format]);
    }

    public function store(CreateRequest $request, $format_id)
    {        
        $this->checklist = Checklist::create(['format_id' => $this->format->id, 'user_id' => Auth::user()->id]);

        $this->checklist->fill($request->all());
        $this->checklist->save();

        $this->checklist->answers()->attach($request->get('answers'));

        Flash::info('Lista de chequeo guardada correctamente');

        return redirect()->route(self::$prefixRoute.'index', $this->format);
    }

    public function show($format_id, $checklist_id)
    {
        return view(self::$prefixView.'show')
            ->with(['checklist' => $this->checklist, 'format' => $this->format]);
    }

    public function download($format_id, $checklist_id)
    {
        $view = view()->make(self::$prefixView.'download')
            ->with(['format' => $this->format, 'checklist' => $this->checklist])
            ->render();

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view)->save('storage/checklists/' . $this->checklist->id . '.pdf');

        return $pdf->stream('checklist.pdf');
    }
}
