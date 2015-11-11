<?php namespace Education\Http\Controllers\Dashboard;

use Education\Http\Controllers\Controller;
use Education\Http\Requests\Roles\CreateRequest;
use Education\Http\Requests\Roles\EditRequest;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Flash, Alert;

use Education\Entities\Role;

class RolesController extends Controller {

    private $role;
    private $form_data;
    private static $prefixRoute = 'roles.';
    private static $prefixView = 'dashboard.pages.companies.users.roles.';

    public function __construct()
    {
        $this->beforeFilter('@newRole', ['only' => ['store','create']]);
        $this->beforeFilter('@findRole', ['only' => ['show', 'edit', 'update', 'destroy']]);
    }

    /**
     * Find a specified resource
     *
     */
    public function findRole(Route $route)
    {
        $this->role = Role::findOrFail($route->getParameter('roles'));
    }

    /**
     * Create a new User instance
     *
     */
    public function newRole()
    {
        $this->role = new Role;
    }

    public function getViewForm($viewName = 'show')
    {
        return view(self::$prefixView . $viewName)
            ->with(['role' => $this->role, 'form_data' => $this->form_data]);
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function index()
	{
        return view(self::$prefixView . 'list');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $this->form_data = ['route' => self::$prefixRoute .'store', 'method' => 'POST'];
        return $this->getViewForm('form');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateRequest $request)
	{
        $this->role->fill($request->all());
        \Auth::user()->rolesCreated()->save($this->role);

        Flash::info('Perfil creado correctamente');

        return redirect()->route(self::$prefixRoute .'index');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return $this->getViewForm();

	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $this->form_data = ['route' => [self::$prefixRoute . 'update', $this->role->id], 'method' => 'PUT','files' => true];
        return $this->getViewForm('form');
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(EditRequest $request, $id)
	{
        $this->role->fill($request->all());
        $this->role->save();

        Flash::info('Perfil editado correctamente');

        return redirect()->route(self::$prefixRoute . 'index');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
    {
        $this->role->delete();

        if (Request::ajax())
        {
            return Response::json(array (
                'success' => true,
                'msg'     => 'Perfil "' . $this->role->name . '" eliminado',
                'id'      => $this->role->id
            ));
        }
        else
        {
            return redirect()->route(self::$prefixRoute . 'index');

        }
	}
}
