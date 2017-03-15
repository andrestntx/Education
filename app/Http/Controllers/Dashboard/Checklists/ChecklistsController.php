<?php

namespace Education\Http\Controllers\Dashboard\Checklists;

use Education\Http\Controllers\BaseResourceController;
use Illuminate\Routing\Route;
use Education\Entities\Format;
use Education\Entities\Checklist;
use Education\Http\Requests\Checklists\CreateRequest;
use Auth;
use Flash;
use App;

class ChecklistsController extends BaseResourceController
{
    private static $prefixRoute = 'myformats.checklists.doit.';
    private static $prefixView = 'dashboard.pages.companies.users.formats.checklists.';

    public function __construct()
    {
        $this->beforeFilter('@validateChecklist', ['only' => ['create']]);
    }

    /**
     * Validate the conditions for a new Checklist.
     */
    public function validateChecklist() // Debe ir en el Request
    {
        if (!$this->format->isAviable()) {
            Flash::warning('El formato no está habilitado');

            return redirect()->route('checklists.doit.index', $this->format);
        }
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

    public function index(Format $format)
    {
        $checklists = $format->getUserChecklists(Auth::user());

        return $this->resourceView('list')->with([
            'checklists' => $checklists,
            'format' => $format
        ]);
    }

    public function create(Format $format)
    {
        $format->load(['questions' => function ($query) {
            $query->orderBy('order', 'asc');
        }]);

        $formData = $this->getFormData('store', 'POST', false, $format);

        return $this->getFormView($format, $formData, 'form', [
            'checklist' => new Checklist
        ]);
    }

    public function store(CreateRequest $request, Format $format)
    {        
        $checklist = Checklist::create([
            'format_id' => $format->id,
            'user_id' => Auth::user()->id
        ]);

        $checklist->fill($request->all());
        $checklist->save();
        $checklist->answers()->attach($request->get('answers'));

        $this->resourceFlash();
        // Flash::info('Lista de chequeo guardada correctamente');

        return $this->resourceRedirect('index', $format);
    }

    public function show(Format $format, Checklist $checklist)
    {
        return $this->resourceView('show')->with([
            'checklist' => $checklist,
            'format' => $format
        ]);
    }

    public function download(Format $format, Checklist $checklist)
    {
        $view = $this->resourceView('download')->with([
                'format' => $format,
                'checklist' => $checklist
            ])
            ->render();

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view)->save('storage/checklists/' . $checklist->id . '.pdf');

        return $pdf->stream('checklist.pdf');
    }

    protected function getResourceEntity()
    {
        return Format::class;
    }
}
