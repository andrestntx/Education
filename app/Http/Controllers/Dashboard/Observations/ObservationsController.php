<?php

namespace Education\Http\Controllers\Dashboard\Observations;

use Education\Http\Controllers\BaseResourceController;
use Education\Repositories\ObservationRepository;
use Education\Entities\ObservationFormat;
use Education\Entities\ObservationFormatUser;
use Education\Http\Requests\Checklists\CreateRequest;
use Flash;
use App;

class ObservationsController extends BaseResourceController
{
    protected $observationRepository;

    public function __construct(ObservationRepository $observationRepository)
    {
        $this->observationRepository = $observationRepository;
    }

    public function allMyFormats()
    {
        return $this->resourceView('format.myformats');
    }

    public function index(ObservationFormat $format)
    {
        $observations = $format->getUserObservations(auth()->user());

        return $this->resourceView('list')->with([
            'observations' => $observations,
            'format' => $format
        ]);
    }

    public function create(ObservationFormat $format)
    {
        $formData = $this->getFormData('store', 'POST', false, $format);
        $format = $this->observationRepository->loadFormatQuestions($format);
        $observation = new ObservationFormatUser();

        return $this->resourceView('form')->with([
            'observation' => $observation,
            'format' => $format,
            'form_data' => $formData
        ]);
    }

    public function store(CreateRequest $request, ObservationFormat $format)
    {
        if (!$format->isAviable()) {
            Flash::warning('El formato no está habilitado');

            return $this->resourceRedirect('index', $format);
        }

        $observation = $this->observationRepository->create($format, $request->all(), $request->get('answers'));
        $this->resourceFlash();

        return $this->resourceRedirect('show', $format, $observation);
    }

    public function show(ObservationFormat $format, ObservationFormatUser $observation)
    {
        $observation = $this->observationRepository->loadAnswers($observation);

        return $this->resourceView('show')->with([
            'observation' => $observation,
            'format' => $format
        ]);
    }

    public function download(ObservationFormat $format, ObservationFormatUser $observation)
    {
        $observation = $this->observationRepository->loadAnswers($observation);

        $view = $this->resourceView('download')
            ->with([
                'format' => $format,
                'observation' => $observation
            ])
            ->render();

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view)->save("storage/checklists/{$observation->id}.pdf");

        return $pdf->stream('observation.pdf');
    }

    protected function getResourceEntity()
    {
        return ObservationFormat::class;
    }
}
