<?php

<?php namespace Education\Http\Controllers\Dashboard;

use Education\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;

use Education\Entities\Protocol;

class ProtocolsController extends <?php

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
		$protocols = Auth::user()->preferredCompany->protocols()->orderBy('id')->get();
		return View::make('dashboard.pages.protocol.lists-table', compact('protocols'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$protocol = new Protocol;
		
		$roles = Auth::user()->preferredCompany->roles()->lists('name', 'id');
		$areas = Auth::user()->preferredCompany->areas()->lists('name', 'id');
		$categories = Auth::user()->preferredCompany->protocolCategories()->lists('name', 'id');
		
		$form_data = array('route' => 'protocolos.store', 'method' => 'POST', 'files' => true);
		return View::make('dashboard.pages.protocol.form', compact('protocol', 'form_data', 'roles', 'areas', 'categories'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $protocol = new Protocol;
        $data = Input::all();

	    if($protocol->validAndSave($data, $data['url_pdf']))
        {
            return Redirect::route('protocolos.index');
        }

		return Redirect::route('protocolos.create')->withInput()->withErrors($protocol->errors);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$protocol = Protocol::findOrFail($id);
		$protocol->load('annex', 'survey.questions');

		$annex = $protocol->annex_file;
		$links = $protocol->annex_link;

		$number_annex = $annex->count();
		$number_links = $links->count();
		$number_questions = $protocol->survey->questions->count();

		return View::make('dashboard.pages.protocol.show-admin', compact('protocol', 
			 'number_questions', 'number_annex', 'annex', 'number_links', 'links'
		));
	}

	public function stats($id)
	{
		$protocol = Protocol::findOrFail($id);
		$users = User::with(array('examScores' => function($query) use($protocol)
		{
		    $query->whereSurveyId($protocol->survey_id);

		}))->canStudyProtocol($protocol->id)->get();	

		return View::make('dashboard.pages.protocol.exams', compact('protocol', 'users'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$protocol = Protocol::findOrFail($id);
		
		$roles = Auth::user()->preferredCompany->roles()->lists('name', 'id');
		$areas = Auth::user()->preferredCompany->areas()->lists('name', 'id');
		$categories = Auth::user()->preferredCompany->protocolCategories()->lists('name', 'id');

		$form_data = array('route' => array('protocolos.update', $protocol->id), 'method' => 'PUT', 'files' => true);
		return View::make('dashboard.pages.protocol.form', compact('roles', 
			'protocol', 'form_data',  'areas', 'categories'
		));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$protocol = Protocol::findOrFail($id);
		$data = Input::all();
        
        if ($protocol->validAndSave($data, $data['url_pdf']))
        {
            return Redirect::route('protocolos.index');
        }
        else
        {
			return Redirect::route('protocolos.edit', $protocol->id)->withInput()->withErrors($protocol->errors);
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
		$protocol = Protocol::findOrFail($id);

    	try {
    		$protocol->delete();
    		$result = array('success' => true, 'msg' => 'Protocolo "' . $protocol->name . '" eliminada', 'id' => $protocol->id);
    	} catch (Exception $e) {
    		$result = array('success' => false, 'msg' => '.', 'id' => $protocol->id);
    	}
   

        if (Request::ajax())
        {
            return Response::json($result);
        }
        else
        {
            return Redirect::route('protocolos.index');
        }
	}
}
