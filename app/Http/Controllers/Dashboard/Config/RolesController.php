<?php
namespace Education\Http\Controllers\Dashboard\Config;

use Education\Http\Controllers\SimpleResourceController;
use Education\Repositories\RoleRepository;
use Education\Http\Requests\Roles\CreateRequest;
use Education\Http\Requests\Roles\EditRequest;
use Education\Entities\Role;
use Illuminate\Support\Facades\Auth;

class RolesController extends SimpleResourceController
{
    protected $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function store(CreateRequest $request)
    {
        $role = $this->roleRepository->createForUser(auth()->user(), $request->all());
        $this->resourceFlash($role->name);

        return $this->resourceRedirect('index');
    }

    public function show(Role $role)
    {
        return $this->resourceView('show')->with([
            'role' => $role
        ]);
    }

    public function edit(Role $role)
    {
        $formData = $this->getFormData('update', 'PUT', true);

        return $this->getFormView($role, $formData);
    }

    public function update(EditRequest $request, Role $role)
    {
        $role = $this->roleRepository->simpleUpdate($role, $request->all());
        $this->resourceFlash($role->name, 'update');

        return $this->resourceRedirect('index');
    }

    public function destroy(Role $role)
    {
        $success = $this->roleRepository->deleteEntity($role);

        return $this->resourceDeleteJson($role->name, $success);
    }

    protected function getResourceEntity()
    {
        return Role::class;
    }
}
