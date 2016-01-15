<?php

namespace Education\Http\Controllers\Dashboard\Maths;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Database\QueryException;
use Education\Http\Controllers\Controller;
use Education\Http\Requests\Maths\CreateRequest;
use Education\Http\Requests\Maths\EditRequest;
use Education\Entities\Math;
use Flash;

class MathsController extends Controller
{
    private $math;
    private $form_data;
    private static $prefixRoute = 'maths.';
    private static $prefixView = 'dashboard.pages.companies.users.maths.';

    public function __construct()
    {
        $this->beforeFilter('@newMath', ['only' => ['store', 'create']]);
        $this->beforeFilter('@findMath', ['only' => ['show', 'edit', 'update', 'destroy']]);
    }

    /**
     * Find a specified resource.
     */
    public function findMath(Route $route)
    {
        $this->math = Math::findOrFail($route->getParameter('maths'));
    }

    /**
     * Create a new User instance.
     */
    public function newMath()
    {
        $this->math = new Math();
    }

    public function getViewForm($viewName = 'show')
    {
        return view(self::$prefixView.$viewName)
            ->with(['math' => $this->math, 'form_data' => $this->form_data]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view(self::$prefixView.'list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->form_data = ['route' => self::$prefixRoute.'store', 'method' => 'POST'];

        return $this->getViewForm('form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateRequest $request)
    {
        $this->math->fill($request->all());
        \Auth::user()->mathsCreated()->save($this->math);

        Flash::info('Fórmula '.$this->math->name.' Guardado correctamente');

        return redirect()->route(self::$prefixRoute.'index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        return $this->getViewForm();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->form_data = ['route' => [self::$prefixRoute.'update', $this->math->id], 'method' => 'PUT','files' => true];

        return $this->getViewForm('form');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update(EditRequest $request, $id)
    {
        $this->math->fill($request->all());
        $this->math->save();

        Flash::info('Fórmula '.$this->math->name.' Actualizada correctamente');

        return redirect()->route(self::$prefixRoute.'index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $data = [
            'success' => true,
            'message' => 'Fórmula eliminada correctamente'
        ];   

        try {
            $this->math->delete(); 
        } catch (QueryException $e) {
            $data['success'] = false;
            $data['message'] = 'La Fórmula no se puede eliminar.';
        }

        return response()->json($data);
        
    }
}
