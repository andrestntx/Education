<?php

namespace Education\Http\Controllers\Dashboard\Checklists;

use Illuminate\Routing\Route;
use Education\Http\Controllers\Controller;
use Education\Entities\format;
use Education\Entities\Checklist;
use Education\Http\Requests\Checklists\CreateRequest;
use Auth;
use Flash;
use App;

class MyFormatChecklistsController extends Controller
{
    private $format;
    private $checklist;

    private static $prefixRoute = 'myformats.checklists.';
    private static $prefixView = 'dashboard.pages.companies.users.formats.';

    public function __construct()
    {
        $this->beforeFilter('@findFormat', ['except' => ['allMyFormats']]);
        $this->beforeFilter('@validateChecklist', ['only' => ['create']]);
        $this->beforeFilter('@newChecklist', ['only' => ['create', 'store']]);
        $this->beforeFilter('@findChecklist', ['only' => ['show', 'download']]);
    }

    /**
     * Find the Format or App Abort 404.
     */
    public function findFormat(Route $route)
    {
        dd('construyendo prueba');
        $this->format = Format::findOrFail($route->getParameter('myformats'));
    }

    /**
     * Validate the conditions for a new Checklist.
     */
    public function validateChecklist()
    {
        if (!$this->format->isAviable()) {
            Flash::warning('El formato no está habilitado');

            return redirect()->route('myformats.checklists.index', $this->format);
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
        $this->checklist = Checklist::findOrFail($route->getParameter('checklists'));
        $this->checklist->load('answers.question');
    }

    public function allMyFormats()
    {
        return view(self::$prefixView.'myformats');
    }

    public function index($format_id)
    {
        dd('prueba');

        $checklists = $this->format->getUserChecklists(Auth::user());

        return view(self::$prefixView.'checklists.list')
            ->with(['checklists' => $checklists, 'format' => $this->format]);
    }

    public function create($format_id)
    {
        $this->format->load('questions');
        $form_data = ['route' => ['myformats.checklists.store', $this->format], 'method' => 'POST'];

        return view(self::$prefixView.'checklists.form', compact('form_data'))
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
        $this->format->load('questions');

        return view(self::$prefixView.'checklists.show')
            ->with(['checklist' => $this->checklist, 'format' => $this->format]);
    }

    public function download($format_id, $checklist_id)
    {
        $this->format->load('questions');

        $view = view()->make(self::$prefixView.'checklists.download')
            ->with(['format' => $this->format, 'checklist' => $this->checklist])
            ->render();

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);

        return $pdf->stream('checklist');
    }
}
