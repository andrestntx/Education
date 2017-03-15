<?php
namespace Education\Http\Controllers\Dashboard\Maths;

use Education\Http\Controllers\SimpleResourceController;
use Education\Repositories\MathRepository;
use Education\Http\Requests\Maths\CreateRequest;
use Education\Http\Requests\Maths\EditRequest;
use Education\Entities\Math;

class MathsController extends SimpleResourceController
{
    protected $mathRepository;

    public function __construct(MathRepository $mathRepository)
    {
        $this->mathRepository = $mathRepository;
    }

    public function store(CreateRequest $request)
    {
        $math = $this->mathRepository->createForUser(auth()->user(), $request->all());
        $this->resourceFlash($math->name);

        return $this->resourceRedirect('index');
    }

    public function show(Math $math)
    {
        return $this->resourceView('show')->with('math', $math);
    }

    public function edit(Math $math)
    {
        $formData = $this->getFormData('update', 'PUT', true, $math);

        return $this->getFormView($math, $formData);
    }

    public function update(EditRequest $request, Math $math)
    {
        $math = $this->mathRepository->simpleUpdate($math, $request->all());
        $this->resourceFlash($math->name, 'update');

        return $this->resourceRedirect('index');
    }

    public function destroy(Math $math)
    {
        $success = $this->mathRepository->deleteEntity($math);

        return $this->resourceDeleteJson($math->math, $success);
    }

    protected function getResourceEntity()
    {
        return Math::class;
    }
}
