<?php

namespace Education\Http\Controllers\Dashboard\Config;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Database\QueryException;
use Education\Http\Controllers\Controller;
use Education\Http\Requests\Categories\CreateRequest;
use Education\Http\Requests\Categories\EditRequest;
use Education\Entities\Category;
use Flash;

class CategoriesController extends Controller
{
    private $category;
    private $form_data;

    private static $prefixRoute = 'categories.';
    private static $prefixView = 'dashboard.pages.companies.users.categories.';

    public function __construct()
    {
        $this->beforeFilter('@newCategory', ['only' => ['create', 'store']]);
        $this->beforeFilter('@findCategory', ['only' => ['show', 'edit', 'update', 'destroy']]);
    }

    /**
     * Create a new Category.
     */
    public function newCategory()
    {
        $this->category = new Category();
    }

    /**
     * Find the Category or App Abort 404.
     */
    public function findCategory(Route $route)
    {
        $this->category = Category::findOrFail($route->getParameter('categories'));
    }

    /**
     * Return the default Form View for Companies.
     */
    public function getFormView($viewName = 'form')
    {
        return view(self::$prefixView.$viewName)
            ->with(['form_data' => $this->form_data, 'category' => $this->category]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view()->make(self::$prefixView.'list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->form_data = ['route' => self::$prefixRoute.'store', 'method' => 'POST'];

        return $this->getFormView();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateRequest $request)
    {
        $this->category->fill($request->all());
        \Auth::user()->categoriesCreated()->save($this->category);

        Flash::info('Categoria '.$this->category->name.' Guardada correctamente');

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
        return view()->make(self::$prefixView.'show');
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
        $this->form_data = ['route' => [self::$prefixRoute.'update', $this->category->id], 'method' => 'PUT', 'files' => true];

        return $this->getFormView();
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
        $this->category->fill($request->all());
        $this->category->save();

        Flash::info('Categoria '.$this->category->name.' Actualizada correctamente');

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
            'message' => 'Categoria eliminada correctamente'
        ];   

        try {
            $this->category->delete(); 
        } catch (QueryException $e) {
            $data['success'] = false;
            $data['message'] = 'La Categoria no se puede eliminar, ya que contiene almenos un Protocolo';
        }

        return response()->json($data);
    }
}
