<?php namespace Education\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Education\Http\Controllers\Controller;
use Education\Http\Requests\Questions\CreateRequest;
use Education\Http\Requests\Questions\EditRequest;
use Education\Entities\Protocol;
use Education\Entities\Question;
use Education\Entities\Answer;
use Flash;

class ProtocolQuestionsController extends Controller {

	private $protocol;
	private $question;
	private $form_data;

	private static $prefixRoute = 'protocols.questions.';
    private static $prefixView  = 'dashboard.pages.companies.users.protocols.questions.';

	public function __construct() 
	{
		$this->beforeFilter('@newQuestion', ['only' => ['create', 'store']]);
		$this->beforeFilter('@findProtocol');
		$this->beforeFilter('@findQuestion', ['only' => ['show', 'edit', 'update']]);
	}

	/**
	 * Create a new Protocol
	 *
	 * @return void
	 */
	public function newQuestion()
	{
		$this->question = new Question;
	}

	/**
	 * Find the Protocol or App Abort 404
	 *
	 * @return void
	 */
	public function findProtocol(Route $route)
	{
	 	$this->protocol = Protocol::findOrFail($route->getParameter('protocols'));
	} 

	/**
	 * Find the Question of Protocol or App Abort 404
	 *
	 * @return void
	 */
	public function findQuestion(Route $route)
	{
	 	$this->question = $this->protocol->questions()->findOrFail($route->getParameter('questions'));
	} 

	/**
	 * Return the default Form View for Companies
	 *
	 * @return void
	 */
	public function getFormView($number_answers = 2, $viewName = 'form')
	{
	 	return view(self::$prefixView . $viewName)
			->with(['form_data' => $this->form_data, 'protocol' => $this->protocol, 'question' => $this->question,
				'number_answers' => $number_answers
			]);
	} 

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function index($protocol_id)
	{
		return redirect()->route('protocols.show', $protocol_id);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request, $protocol_id)
	{	
		$this->form_data = ['route' => [self::$prefixRoute . 'store', $this->protocol->id], 'method' => 'POST'];
		return $this->getFormView($request->get('answers'));
		
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateRequest $request, $protocol_id)
	{
        $this->question->fill($request->all());
		$this->protocol->questions()->save($this->question);

		$answers = $request->get('answers');
		$answers[$request->get('answers_correct')]['correct'] = 1;

		$newAnswers = [];

		foreach($answers as $answer) 
		{
			array_push($newAnswers, new Answer($answer));	
		}
		$this->question->answers()->saveMany($newAnswers);
        Flash::info('Pregunta  Guardada correctamente');

        return redirect()->route('protocols.show', $this->protocol->id);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($protocol_id, $question_id)
	{
		$this->form_data = ['route' => [self::$prefixRoute . 'update', $this->protocol->id, $this->question->id], 'method' => 'PUT'];
		return $this->getFormView();
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(EditRequest $request, $protocol_id, $question_id)
	{
        $this->question->fillAndClear($request->all());
        $this->question->save();
        $this->question->answers()->update(['correct' => 0]);

        $answers = $request->get('answers');
		$answers[$request->get('answers_correct')]['correct'] = 1;

		foreach ($answers as $id => $answer) 
		{
			Answer::findOrFail($id)->fill($answer)->save();
		}

        Flash::info('Pregunta  Actualizada correctamente');

        return redirect()->route('protocols.show', $this->protocol->id);
	}

}
