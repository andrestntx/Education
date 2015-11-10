<?php

<?php namespace Education\Http\Controllers\Dashboard;

use Education\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;

use Education\Entities\Question;

class QuestionsController extends <?php

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
		$type_id = 1;
		$question = new Question;

		$number_answers = Input::get('respuestas');
		$form_data = array('route' => array('protocolos.preguntas.store', $protocol_id), 'method' => 'POST', 'files' => true);
		return View::make('dashboard.pages.question.form', compact('question', 'form_data', 'protocol', 'number_answers', 'type_id'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($protocol_id)
	{
        $question = new Question;
        $data = Input::all();

        if ($question->validAndSave($data))
        {
            return Redirect::route('protocolos.preguntas.index', $protocol_id);
        }
        else
        {
			return Redirect::route('protocolos.preguntas.create', array($protocol_id, 'respuestas='.count($data['answers'])))->withInput()->withErrors($question->errors);
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
		//
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
		$type_id = 1;
		$question = $protocol->survey->questions()->findOrFail($id);

		$form_data = array(
			'route' => array('protocolos.preguntas.update', $protocol->id, $question->id), 
			'method' => 'PUT', 
			'files' => true
		);

		return View::make('dashboard.pages.question.form', compact('question', 'form_data', 'protocol', 'type_id'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($protocol_id, $id)
	{
        $question = Question::find($id);
        $data = Input::all();

        if ($question->validAndSave($data))
        {
            return Redirect::route('protocolos.preguntas.index', $protocol_id);
        }
        else
        {
			return Redirect::route('protocolos.preguntas.edit', array($protocol_id, $id))->withInput()->withErrors($question->errors);
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
    	$question = Question::findOrFail($id);
        $question->delete();

        if (Request::ajax())
        {
            return Response::json(array (
                'success' => true,
                'msg'     => 'Pregunta "' . $question->text . '" eliminada',
                'id'      => $question->id
            ));
        }
        else
        {
            return Redirect::route('protocolos.show', $protocol_id);
        }
	}


}
