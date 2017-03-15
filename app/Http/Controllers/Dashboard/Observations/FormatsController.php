<?php
namespace Education\Http\Controllers\Dashboard\Observations;

use Education\Entities\Format;
use Education\Http\Controllers\SimpleResourceController;
use Education\Http\Requests\Formats\CreateRequest;
use Education\Http\Requests\Formats\EditRequest;
use Education\Repositories\FormatRepository;

class FormatsController extends SimpleResourceController
{
    protected $formatRepository;

    public function __construct(FormatRepository $formatRepository)
    {
        $this->formatRepository = $formatRepository;
    }


    public function store(CreateRequest $request)
    {
        $format = $this->formatRepository->createForUser(auth()->user(), $request->all());
        $this->resourceFlash($format->name);

        return $this->resourceRedirect('show', $format);
    }

    public function show(Format $format)
    {
        $format->load(['questions' => function ($query) {
            $query->orderBy('order', 'asc');
        }]);

        return $this->resourceView('show')->with('format', $format);
    }


    public function edit(Format $format)
    {
        $formData = $this->getFormData('update', 'PUT', false, $format);

        return $this->getFormView($format, $formData);
    }


    public function update(EditRequest $request, Format $format)
    {
        $format = $this->formatRepository->update($format, $request->all());
        $this->resourceFlash($format->name);

        return $this->resourceRedirect('show', $format);
    }

    public function destroy(Format $format)
    {
        $success = $this->formatRepository->deleteEntity($format);

        return $this->resourceDeleteJson($format->name, $success);
    }

    protected function getResourceEntity()
    {
        return Format::class;
    }
}
