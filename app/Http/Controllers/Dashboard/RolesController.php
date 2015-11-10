<?php

<?php namespace Education\Http\Controllers\Dashboard;

use Education\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;

use Education\Entities\Role;

class RolesController extends <?php

<?php namespace Education\Http\Controllers\Dashboard;

use Education\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;

use Education\Entities\Company;
Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function index()
	{
		$roles = Auth::user()->preferredCompany->roles()->orderBy('id')->get();
		return View::make('dashboard.pages.user.role.lists-table', compact('roles'));
		
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$role = new UserRole;
		$form_data = array('route' => 'usuarios.perfiles.store', 'method' => 'POST');
		return View::make('dashboard.pages.user.role.form', compact('role', 'form_data'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $role = new UserRole;
        $data = Input::all();
        
        if ($role->validAndSave($data))
        {
            return Redirect::route('usuarios.perfiles.index');
        }
        else
        {
			return Redirect::route('usuarios.perfiles.create')->withInput()->withErrors($role->errors);
        }
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$role = UserRole::findOrFail($id);
		return View::make('dashboard.pages.user.role.show', compact('action_role', 'role'));

	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$role = UserRole::findOrFail($id);
		$form_data = array('route' => array('usuarios.perfiles.update', $role->id), 'method' => 'PUT', 'files' => true);
		return View::make('dashboard.pages.user.role.form', compact('role', 'form_data'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$role = UserRole::findOrFail($id);
		
        $data = Input::all();
        if ($role->validAndSave($data))
        {
            return Redirect::route('usuarios.perfiles.index');
        }
        else
        {
			return Redirect::route(array('usuarios.perfiles.edit', $role->id))->withInput()->withErrors($role->errors);
        }	
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
    {
    	$role = UserRole::findOrFail($id);
    	
        $role->delete();

        if (Request::ajax())
        {
            return Response::json(array (
                'success' => true,
                'msg'     => 'Perfil "' . $role->name . '" eliminado',
                'id'      => $role->id
            ));
        }
        else
        {
            return Redirect::route('usuarios.perfiles.index');
        }
	}
}
