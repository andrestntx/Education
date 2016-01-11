<?php

namespace Education\Http\Controllers\Dashboard\Observations;

use Illuminate\Routing\Route;
use Education\Http\Controllers\Controller;
use Education\Entities\ObservationFormat;
use Education\Entities\ObservationFormatUser;
use Education\Http\Requests\Checklists\CreateRequest;
use Auth;
use Flash;
use App;

class ObservationsController extends Controller
{
    private $format;
    private $observation;

    private static $prefixRoute = 'myformats.observations.doit.';
    private static $prefixView = 'dashboard.pages.companies.users.formats.observations.';

    public function __construct()
    {
        $this->beforeFilter('@findFormat', ['except' => ['allMyFormats']]);
        $this->beforeFilter('@validateObservationFormatUser', ['only' => ['create']]);
        $this->beforeFilter('@newObservationFormatUser', ['only' => ['create', 'store']]);
        $this->beforeFilter('@findObservationFormatUser', ['only' => ['show', 'download']]);
        $this->beforeFilter('@loadQuestions', ['only' => ['create']]);
    }

    /**
     * Find the Format or App Abort 404.
     */
    public function findFormat(Route $route)
    {
        $this->format = ObservationFormat::findOrFail($route->getParameter('observations'));
    }

    public function loadQuestions()
    {
        $this->format->load(['questions' => function ($query) {
            $query->orderBy('order', 'asc');
        }]);
    }

    /**
     * Validate the conditions for a new Observation.
     */
    public function validateObservationFormatUser()
    {
        if (!$this->format->isAviable()) {
            Flash::warning('El formato no está habilitado');

            return redirect()->route(self::$prefixRoute . 'index', $this->format);
        }
    }

    /**
     * Create a new ObservationFormatUser.
     */
    public function newObservationFormatUser()
    {
        $this->observation = new ObservationFormatUser();
    }

    /**
     * Find the ObservationFormatUser or App Abort 404.
     */
    public function findObservationFormatUser(Route $route)
    {
        $this->observation = ObservationFormatUser::findOrFail($route->getParameter('doit'));
        $this->observation->load('answers.question');

        $this->observation->answers = $this->observation->answers->sortBy(function ($answer, $key) {
            return $answer->question->order;
        });
    }

    public function allMyFormats()
    {
        return view(self::$prefixView . 'format.myformats');
    }

    public function index($format_id)
    {
        $observations = $this->format->getUserObservations(Auth::user());

        return view(self::$prefixView . 'list')
            ->with(['observations' => $observations, 'format' => $this->format]);
    }

    public function create($format_id)
    {

        $form_data = ['route' => [self::$prefixRoute . 'store', $this->format], 'method' => 'POST'];

        return view(self::$prefixView.'form', compact('form_data'))
            ->with(['observation' => $this->observation, 'format' => $this->format]);
    }

    public function store(CreateRequest $request, $format_id)
    {
        $this->observation = ObservationFormatUser::create(['observation_format_id' => $this->format->id, 'user_id' => Auth::user()->id]);
        $this->observation->fill($request->all());
        $this->observation->save();

        $this->observation->answers()->attach($request->get('answers'));

        Flash::info('Lista de chequeo guardada correctamente');

        return redirect()->route(self::$prefixRoute.'show', [$this->format, $this->observation]);
    }

    public function show($format_id, $observation_id)
    {
        return view(self::$prefixView.'show')
            ->with(['observation' => $this->observation, 'format' => $this->format]);
    }

    public function download($format_id, $observation_id)
    {
        $view = view()->make(self::$prefixView.'download')
            ->with(['format' => $this->format, 'observation' => $this->observation])
            ->render();

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view)->save('storage/checklists/' . $this->observation->id . '.pdf');

        return $pdf->stream('observation.pdf');
    }
}
