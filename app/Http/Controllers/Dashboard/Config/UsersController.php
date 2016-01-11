<?php

namespace Education\Http\Controllers\Dashboard\Config;

use Illuminate\Routing\Route;
use Illuminate\Database\QueryException;
use Education\Http\Controllers\Controller;
use Education\Http\Requests\Users\CreateRequest;
use Education\Http\Requests\Users\EditRequest;
use Education\Http\Requests\Users\ProfileRequest;
use Education\Entities\User;
use Flash;
use Auth;

class UsersController extends Controller
{
    private $user;
    private $form_data;
    private static $prefixRoute = 'users.';
    private static $prefixView = 'dashboard.pages.companies.users.admin.';

    public function __construct()
    {
        $this->beforeFilter('@newUser', ['only' => ['store', 'create']]);
        $this->beforeFilter('@findUser', ['only' => ['show', 'edit', 'update', 'destroy', 'scores']]);
    }

    /**
     * Find a specified resource.
     */
    public function findUser(Route $route)
    {
        $this->user = User::findOrFail($route->getParameter('users'));
    }
    /**
     * Create a new User instance.
     */
    public function newUser()
    {
        $this->user = new User();
    }

    public function getViewForm($viewName = 'form')
    {
        return view(self::$prefixView.$viewName)
            ->with(['user' => $this->user, 'form_data' => $this->form_data]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view(self::$prefixView.'list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->form_data = ['route' => self::$prefixRoute.'store', 'method' => 'POST', 'files' => true];

        return $this->getViewForm();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateRequest $request)
    {
        $this->user->fill($request->all());
        \Auth::user()->company->users()->save($this->user);
        $this->user->syncRelations($request->all());
        $this->user->uploadImage($request->file('url_photo'));

        Flash::info('Usuario '.$this->user->name.' Guardado correctamente');

        return redirect()->route(self::$prefixRoute.'index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->form_data = ['route' => [self::$prefixRoute.'update', $this->user->id], 'method' => 'PUT', 'files' => true];

        return $this->getViewForm('form');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update(EditRequest $request)
    {
        $this->user->fill($request->all());
        $this->user->save();
        $this->user->syncRelations($request->all());
        $this->user->uploadImage($request->file('url_photo'));

        Flash::info('Usuario '.$this->user->name.' Actualizado correctamente');

        return redirect()->route(self::$prefixRoute.'index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $data = [
            'success' => true,
            'message' => 'Usuario eliminado correctamente'
        ];   

        if($this->user->canDestroy()){
            try {
                $this->user->detachAndDelete();
            } catch (QueryException $e) {
                $data['success'] = false;
                $data['message'] = 'El Usuario no se puede eliminar';
            }    
        }
        else{
            $data['success'] = false;
            $data['message'] = 'El Usuario no se puede eliminar, ya que tiene examenes asociados';
        }

        return response()->json($data);
    }

    public function scores($id)
    {
        return view()->make('dashboard.pages.companies.users.scores')->with('user', $this->user);
    }

    public function profile(ProfileRequest $request)
    {
        $this->user = Auth::user();
        $this->user->fill($request->all());
        $this->user->save();
        $this->user->uploadImage($request->file('url_photo'));

        Flash::info('Pefil actualizado correctamente');

        return redirect()->route(self::$prefixRoute.'index');
    }
}
