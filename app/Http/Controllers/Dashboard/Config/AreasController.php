<?php
namespace Education\Http\Controllers\Dashboard\Config;

use Education\Http\Controllers\SimpleResourceController;
use Education\Repositories\AreaRepository;
use Education\Http\Requests\Areas\CreateRequest;
use Education\Http\Requests\Areas\EditRequest;
use Education\Entities\Area;
use Illuminate\Support\Facades\Auth;

class AreasController extends SimpleResourceController
{
    protected $areaRepository;

    public function __construct(AreaRepository $areaRepository)
    {
        $this->areaRepository = $areaRepository;
    }

    public function create()
    {
        $formData = $this->getFormData('store', 'POST');

        return $this->getFormView(new Area, $formData);
    }

    public function store(CreateRequest $request)
    {
        $area = $this->areaRepository->createForUser(Auth::user(), $request->all());
        $this->resourceFlash($area->name);

        return $this->resourceRedirect('index');
    }

    public function show(Area $area)
    {
        return $this->resourceView('show')->with([
            'area' => $area
        ]);
    }

    public function edit(Area $area)
    {
        $formData = $this->getFormData('update', 'PUT', true, $area);

        return $this->getFormView($area, $formData);
    }


    public function update(EditRequest $request, Area $area)
    {
        $this->areaRepository->simpleUpdate($area, $request->all());
        $this->resourceFlash($area->name);

        return $this->resourceRedirect('index');
    }

    public function destroy(Area $area)
    {
        $success = $this->areaRepository->deleteEntity($area);

        return $this->resourceDeleteJson($area->name, $success);
    }

    protected function getResourceEntity()
    {
        return Area::class;
    }
}
