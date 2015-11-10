<?php

<?php namespace Education\Http\Controllers\Dashboard;

use Education\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;

use Education\Entities\Annex;

class AnnexController extends <?php

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


	public function index($protocol_id)
	{
		//$protocol = Protocol::findOrFail($protocol_id);
		//$annex = $protocol->annex()->orderBy('id')->paginate(20);

		//return View::make('dashboard.pages.anexos.lists-table', compact('annex', 'protocol')); 
		return Redirect::route('protocolos.show', $protocol_id);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($protocol_id)
	{
		$protocol = Protocol::findOrFail($protocol_id);
		$annex = new Annex;
		$form_data = array('route' => array('protocolos.anexos.store', $protocol_id), 'method' => 'POST', 'files' => true);
		return View::make('dashboard.pages.annex.form', compact('annex', 'form_data', 'protocol'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($protocol_id)
	{
        $annex = new Annex;
        $data = Input::all();
        $file = Input::file('url');

        if ($annex->validAndSave($data, $file))
        {
            return Redirect::route('protocolos.show', $protocol_id);
        }
        else
        {
			return Redirect::route('protocolos.anexos.create', $protocol_id)->withInput()->withErrors($annex->errors);
        }
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($protocol_id, $id)
	{
		$annex = Protocol::findOrFail($protocol_id)->annex()->findOrFail($id);
		return View::make('dashboard.pages.models.show', compact('annex'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($protocol_id, $id)
	{
		$protocol = Protocol::findOrFail($protocol_id);
		$annex = $protocol->annex()->findOrFail($id);

		$form_data = array(
			'route' => array('protocolos.anexos.update', $protocol->id, $annex->id), 
			'method' => 'PUT', 
			'files' => true
		);

		return View::make('dashboard.pages.annex.form', compact('annex', 'form_data', 'protocol'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($protocol_id, $id)
	{
		$annex = Annex::findOrFail($id);
        $data = Input::all();
        $file = Input::file('url');

        if ($annex->validAndSave($data, $file))
        {
            return Redirect::route('protocolos.show', $protocol_id);
        }
        else
        {
			return Redirect::route('protocolos.anexos.edit', $annex->id)->withInput()->withErrors($annex->errors);
        }	
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($protocol_id, $id)
	{
    	$annex = Annex::findOrFail($id);
        $annex->delete();

        if (Request::ajax())
        {
            return Response::json(array (
                'success' => true,
                'msg'     => 'Protocolo "' . $annex->name . '" eliminado',
                'id'      => $annex->id
            ));
        }
        else
        {
            return Redirect::route('protocolos.anexos.index', $protocol_id);
        }
	}


}
