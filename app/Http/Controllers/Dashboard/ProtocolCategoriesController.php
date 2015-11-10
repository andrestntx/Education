<?php

<?php namespace Education\Http\Controllers\Dashboard;

use Education\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;

use Education\Entities\Category;

class ProtocolCategoriesController extends <?php

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
	private static $module_id = 10;

	public function index()
	{
		$categories = Auth::user()->preferredCompany->protocolCategories()->orderBy('id')->get();
		return View::make('dashboard.pages.protocol.category.lists-table', compact('categories'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		
		$category = new ProtocolCategory;
		
		$form_data = array('route' => 'protocolos.categorias.store', 'method' => 'POST');
		return View::make('dashboard.pages.protocol.category.form', compact('action_model', 'category', 'module', 'form_data'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $category = new ProtocolCategory;
        $data = Input::all();
        
        if ($category->validAndSave($data))
        {
            return Redirect::route('protocolos.categorias.index');
        }
        else
        {
			return Redirect::route('protocolos.categorias.create')->withInput()->withErrors($category->errors);
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
		$category = ProtocolCategory::findOrFail($id);
		return View::make('dashboard.pages.protocol.category.show', compact('category'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$category = ProtocolCategory::findOrFail($id);
		$form_data = array('route' => array('protocolos.categorias.update', $category->id), 'method' => 'PUT', 'files' => true);
		return View::make('dashboard.pages.protocol.category.form', compact('category', 'form_data'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$category = ProtocolCategory::findOrFail($id);
		
        $data = Input::all();
        if ($category->validAndSave($data))
        {
            return Redirect::route('protocolos.categorias.index');
        }
        else
        {
			return Redirect::route(array('protocolos.categorias.edit', $category->id))->withInput()->withErrors($category->errors);
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
    	$category = ProtocolCategory::findOrFail($id);
    	
        $category->delete();

        if (Request::ajax())
        {
            return Response::json(array (
                'success' => true,
                'msg'     => 'Categoría "' . $category->name . '" eliminada',
                'id'      => $category->id
            ));
        }
        else
        {
            return Redirect::route('protocolos.categorias.index');
        }
	}
}
