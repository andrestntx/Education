<?php
namespace Education\Http\Controllers\Dashboard\Config;

use Education\Http\Controllers\SimpleResourceController;
use Education\Http\Requests\Users\CreateRequest;
use Education\Http\Requests\Users\EditRequest;
use Education\Http\Requests\Users\ProfileRequest;
use Education\Entities\User;
use Education\Repositories\UserRepository;
use Flash;
use Auth;

class UsersController extends SimpleResourceController
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function inactive()
    {
        return $this->resourceView('inactive');
    }

    public function store(CreateRequest $request)
    {
        $user = $this->userRepository->createForCompany(auth()->user()->company, $request->all(), $request->file('url_photo'));
        $this->resourceFlash($user->name);

        return $this->resourceRedirect('index');
    }


    public function edit(User $user)
    {
        $formData = $this->getFormData('update', 'PUT', true, $user);

        return $this->getFormView($user, $formData);
    }

    public function update(EditRequest $request, User $user)
    {
        $user = $this->userRepository->update($user, $request->all(), $request->file('url_photo'));
        $this->resourceFlash($user->name);

        return $this->resourceRedirect('index');
    }

    public function destroy(User $user)
    {
        $data = [
            'success' => true,
            'message' => 'Usuario deshabilitado',
            'status'  => 'info'
        ];   

        $user->inactivate();

        return response()->json($data);
    }

    public function activate(User $user)
    {
        $data = [
            'success' => true,
            'message' => 'Usuario habilitado',
            'status'  => 'info'
        ];   

        $user->activate();

        return response()->json($data);
    }

    public function scores(User $user)
    {
        return view()->make('dashboard.pages.companies.users.scores')->with('user', $user);
    }

    public function profile(ProfileRequest $request)
    {
        $user = Auth::user();
        $this->userRepository->update($user, $request->all(), $request->file('url_photo'));
        $this->resourceFlash('Perfil', 'update');

        return $this->resourceRedirect('index');
    }

    protected function getResourceEntity()
    {
        return User::class;
    }
}
