<?php

namespace Education\Http\Controllers\Dashboard\Protocols\Generator;

use Education\Entities\Generator;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

use Education\Http\Requests;
use Education\Http\Requests\ProtocolGenerator\FormRequest;
use Education\Http\Controllers\Controller;
use Education\Entities\GeneratedProtocol;
use Auth, Flash, App;

class GeneratedProtocolsController extends Controller
{
    private static $prefixRoute = 'generators.generated-protocols.';
    private static $prefixView = 'dashboard.pages.companies.users.protocols.generator.';

    /**
     * Display a listing of the resource.
     *
     * @param Generator $generator
     * @return \Illuminate\Http\Response
     */
    public function index(Generator $generator)
    {
        return redirect()->to('generators');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Generator $generator
     * @return \Illuminate\Http\Response
     */
    public function create(Generator $generator)
    {
        $questions = $generator->firstQuestionsAviable();

        return view(self::$prefixView . 'form')->with([
            'form_data'         => ['route' => [self::$prefixRoute . 'store', $generator], 'method' => 'POST'],
            'generatedProtocol' => new GeneratedProtocol(),
            'questions'         => $questions
        ]);
    }


    /**
     * @param FormRequest $request
     * @param Generator $generator
     * @param GeneratedProtocol $generatedProtocol
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FormRequest $request, Generator $generator, GeneratedProtocol $generatedProtocol)
    {
        $generatedProtocol->fill($request->all() + ['user_id' => Auth::user()->id]);
        $generator->generatedProtocols()->save($generatedProtocol);

        if($request->get('questions')) {
            $generatedProtocol->questions()->sync($request->get('questions'));
        }
        
        Flash::info('Protocolo generado correctamente');
        return redirect()->route('generators.show', $generator);
    }


    /**
     * @param Generator $generator
     * @param GeneratedProtocol $generatedProtocol
     * @return mixed
     */
    public function show(Generator $generator, GeneratedProtocol $generatedProtocol)
    {
        $generatedProtocol->load(['generator', 'questions' => function ($query) {
            $query->orderBy('order', 'asc');    
        }]);

        $view = view()->make(self::$prefixView.'download')
            ->with(['generatedProtocol' => $generatedProtocol])
            ->render();

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view)->save('storage/generatedProtocols/' . $generatedProtocol->id . '.pdf');

        return $pdf->stream('generatedProtocol.pdf');
    }


    /**
     * @param Generator $generator
     * @param GeneratedProtocol $generatedProtocol
     * @return $this
     */
    public function edit(Generator $generator, GeneratedProtocol $generatedProtocol)
    {
        $questions = $generator->firstQuestionsAviable();

        return view(self::$prefixView . 'form')->with([
            'form_data'         => ['route' => [self::$prefixRoute . 'update', $generator, $generatedProtocol], 'method' => 'PUT'],
            'generatedProtocol' => $generatedProtocol,
            'questions'         => $questions
        ]);
    }


    /**
     * @param FormRequest $request
     * @param Generator $generator
     * @param GeneratedProtocol $generatedProtocol
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(FormRequest $request, Generator $generator, GeneratedProtocol $generatedProtocol)
    {
        $generatedProtocol->fill($request->all());
        $generatedProtocol->save();

        if($request->get('questions')) {
            $generatedProtocol->questions()->sync($request->get('questions'));
        }

        Flash::info('Protocolo generado correctamente');
        return redirect()->route('generators.show', $generator);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
