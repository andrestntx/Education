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

class ProtocolGeneratorController extends Controller
{
    private $company;
    private $question;

    private static $prefixRoute = 'generators.';
    private static $prefixView = 'dashboard.pages.companies.users.protocols.generator.';


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view(self::$prefixView . 'all');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(self::$prefixView . 'form-generator')->with([
            'generator' => new Generator(),
            'form_data' => ['route' => ['generators.store']]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $generator = new Generator();
        $generator->fill($request->all());

        Auth::user()->company->generators()->save($generator);

        return redirect()->route('generators.index');
    }


    /**
     * @param Generator $generator
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show(Generator $generator)
    {
        return redirect()->route('generators.questions.index', $generator);
    }


    /**
     * @param Generator $generator
     * @return $this
     */
    public function edit(Generator $generator)
    {
        return view(self::$prefixView . 'form-generator')->with([
            'generator' => $generator,
            'form_data' => ['route' => ['generators.update', $generator], 'method' => 'PUT']
        ]);
    }


    public function update(Request $request, Generator $generator)
    {
        $generator->fill($request->all());
        $generator->save();

        return redirect()->route('generators.index');
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
