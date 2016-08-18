<?php

namespace Education\Http\Controllers\Dashboard\Protocols\Generator;

use Education\Entities\Generator;
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

    private static $prefixRoute = 'generators.';
    private static $prefixView = 'dashboard.pages.companies.users.protocols.generator.';


    /**
     * @param Generator $generator
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Generator $generator)
    {
        return view(self::$prefixView . 'config')->with([
            'generator' => $generator
        ]);
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
     * @param  \Illuminate\Http\Request $request
     * @param Generator $generator
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Generator $generator)
    {
        $question         = new Question;
        $question->text   = $request->get('newQuestion');
        $question->order  = $generator->orderNewQuestion();

        $generator->questions()->save($question);

        return ['success' => 'true', 'question' => $question];
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
     * @param Request $request
     * @param Question $question
     * @return array
     */
    public function update(Request $request, Question $question)
    {
        $question->text = $request->get('value');
        $question->save();
        
        return ['success' => true];
    }


    /**
     * @param Generator $generator
     * @param Question $question
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Generator $generator, Question $question)
    {
        $data = [
            'success' => true,
            'message' => 'Pregunta eliminada correctamente'
        ];   

        try {
            $question->delete();
        } catch (QueryException $e) {
            $data['success'] = false;
            $data['message'] = 'La Pregunta no se puede eliminar, ya que contiene almenos un Protocolo generado';
        }

        return response()->json($data);
    }

    /**
     * @param Request $request
     * @param Generator $generator
     * @return array
     */
    public function order(Request $request, Generator $generator)
    {
        $generator->reorderQuestions(json_decode($request->get('questions')));

        return ['success' => true];
    }

    /**
     * @param Request $request
     * @param Generator $generator
     * @param Question $question
     * @return array
     */
    public function changeAviable(Request $request, Generator $generator, Question $question)
    {
        $question->aviable = ! $question->aviable;
        $question->save();

        return ['success' => true, 'state' => $question->aviable, 'message' => 'Cambio exitoso'];
    }

}
