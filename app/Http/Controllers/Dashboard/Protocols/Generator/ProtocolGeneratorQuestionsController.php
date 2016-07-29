<?php

namespace Education\Http\Controllers\Dashboard\Protocols\Generator;

use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use Education\Http\Requests;
use Education\Http\Requests\ProtocolGenerator\OrderRequest;
use Education\Http\Controllers\Controller;
use Education\Entities\Question;
use Auth, Log;

class ProtocolGeneratorQuestionsController extends Controller
{
    private $company;
    private $question;
    private $form_data;

    private static $prefixRoute = 'protocol-generator.';
    private static $prefixView = 'dashboard.pages.companies.users.protocols.generator.';

    public function __construct()
    {
        $this->beforeFilter('@findCompnay');
        $this->beforeFilter('@newQuestion', ['only' => ['create', 'store']]);
        $this->beforeFilter('@findQuestion', ['only' => ['show', 'edit', 'update', 'destroy', 'changeAviable']]);
    }

    /**
     * Set the Auth User Company
     */
    public function findCompnay()
    {
        $this->company = Auth::user()->company;
    }

    /**
     * Create a new Question.
     */
    public function newQuestion()
    {
        $this->question = new Question;
    }

    /**
     * Find the Company or App Abort 404.
     */
    public function findQuestion(Route $route)
    {
        $this->question = $this->company->protocolGeneratorQuestions()
            ->findOrFail($route->getParameter('protocol_generator'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view(self::$prefixView.'config');    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->question         = new Question;
        $this->question->text   = $request->get('newQuestion');
        $this->question->order  = $this->company->orderNewQuestion();

        Auth::user()->company->protocolGeneratorQuestions()->save($this->question);

        return ['success' => 'true', 'question' => $this->question];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->question->text = $request->get('value');
        $this->question->save();
        
        return ['success' => true];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = [
            'success' => true,
            'message' => 'Pregunta eliminada correctamente'
        ];   

        try {
            $this->question->delete(); 
        } catch (QueryException $e) {
            $data['success'] = false;
            $data['message'] = 'La Pregunta no se puede eliminar, ya que contiene almenos un Protocolo generado';
        }

        return response()->json($data);
    }

    public function order(Request $request)
    {
        $this->company->reorderQuestions(json_decode($request->get('questions')));

        return ['success' => true];
    }

    public function changeAviable(Request $request)
    {
        $this->question->aviable = ! $this->question->aviable;
        $this->question->save();

        return ['success' => true, 'state' => $this->question->aviable, 'message' => 'Cambio exitoso'];
    }

}
