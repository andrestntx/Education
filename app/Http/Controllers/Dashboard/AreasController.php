<?php

<?php namespace Education\Http\Controllers\Dashboard;

use Education\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;

use Education\Entities\Area;

class AreasController extends <?php

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
		$areas = Auth::user()->preferredCompany->areas()->orderBy('id')->get();
		return View::make('dashboard.pages.area.lists-table', compact('areas'));
		
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$area = new Area;		
		$form_data = array('route' => 'areas.store', 'method' => 'POST');
		return View::make('dashboard.pages.area.form', compact('area', 'form_data'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $area = new Area;
        $data = Input::all();
        
        if ($area->validAndSave($data))
        {
            return Redirect::route('areas.index');
        }
        else
        {
			return Redirect::route('areas.create')->withInput()->withErrors($area->errors);
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
		$area = Area::findOrFail($id);
		return View::make('dashboard.pages.area.show', compact('area'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$area = Area::findOrFail($id);
		$form_data = array('route' => array('areas.update', $area->id), 'method' => 'PUT', 'files' => true);
		return View::make('dashboard.pages.area.form', compact('area', 'form_data'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$area = Area::findOrFail($id);
		
        $data = Input::all();
        if ($area->validAndSave($data))
        {
            return Redirect::route('areas.index');
        }
        else
        {
			return Redirect::route(array('areas.edit', $area->id))->withInput()->withErrors($area->errors);
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
    	$area = Area::findOrFail($id);
    	
        $area->delete();

        if (Request::ajax())
        {
            return Response::json(array (
                'success' => true,
                'msg'     => 'Área "' . $area->name . '" eliminada',
                'id'      => $area->id
            ));
        }
        else
        {
            return Redirect::route('areas.index');
        }
	}
}
