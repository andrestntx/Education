<?php
namespace Education\Http\Controllers\Dashboard;

use Education\Http\Controllers\ResourceController;
use Education\Http\Requests\Companies\Users\CreateRequest;
use Education\Http\Requests\Companies\Users\EditRequest;
use Education\Entities\Company;
use Education\Entities\User;

class CompanyUsersController extends ResourceController
{
    public function index(Company $company)
    {
        $users = $company->userAdmins();

        return $this->resourceView('list')->with([
            'company' => $this->company,
            'users' => $users
        ]);
    }

    public function create(Company $company)
    {
        $formData = $this->getFormData('store', 'POST', true, $company);

        return $this->getFormView($company, $formData);
    }

    public function store(CreateRequest $request, Company $company)
    {
        $user = new User($request->all());
        $company->users()->save($this->user);
        $user->uploadImage($request->file('url_photo'));

        $this->resourceFlash($company);

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
        $formData = [
            'route' => [self::$prefixRoute.'update', $this->company->id, $this->user->id],
            'method' => 'PUT', 'files' => true,
        ];

        return $this->getFormView($company, $formData);
    }

    public function update(EditRequest $request, Company $company, User $user)
    {
        $this->user->fill($request->all());
        $this->user->save();
        $this->user->uploadImage($request->file('url_photo'));

        $this->resourceFlash($company, 'update');

        //Flash::info('Administrador '.$this->user->name.' Actualizado correctamente');

        return $this->resourceRedirect('index', $company);
    }

    protected function getResourceEntity()
    {
        return User::class;
    }
}
