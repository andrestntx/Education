<?php
namespace Education\Http\Controllers\Dashboard;

use Education\Http\Controllers\BaseResourceController;
use Education\Http\Requests\Companies\Users\CreateRequest;
use Education\Http\Requests\Companies\Users\EditRequest;
use Education\Entities\Company;
use Education\Entities\User;

class CompanyUsersController extends BaseResourceController
{
    public function index(Company $company)
    {
        $users = $company->userAdmins();

        return $this->resourceView('list')->with([
            'company' => $company,
            'users' => $users
        ]);
    }

    public function create(Company $company)
    {
        $formData = $this->getFormData('store', 'POST', true, $company);

        return $this->getFormView(new User, $formData, 'form', [
            'company' => $company
        ]);
    }

    public function store(CreateRequest $request, Company $company)
    {
        $user = new User($request->all());
        $company->users()->save($this->user);
        $user->uploadImage($request->file('url_photo'));

        $this->resourceFlash($user->name);

        //Flash::info('Administrador '.$this->user->name.' Guardado correctamente');

        return $this->resourceRedirect('index', $company);
    }

    public function show(Company $company, User $user)
    {
        return $this->resourceView('show')->with([
            'user' => $user
        ]);
    }

    public function edit(Company $company, User $user)
    {
        $formData = $this->getFormData('update', 'PUT', true, [$company, $user]);

        return $this->getFormView($user, $formData, 'form', [
            'company' => $company
        ]);
    }

    public function update(EditRequest $request, Company $company, User $user)
    {
        $user->fill($request->all());
        $user->save();
        $user->uploadImage($request->file('url_photo'));

        $this->resourceFlash($user->name, 'update');

        //Flash::info('Administrador '.$this->user->name.' Actualizado correctamente');

        return $this->resourceRedirect('index', $company);
    }

    protected function getResourceEntity()
    {
        return User::class;
    }
}
