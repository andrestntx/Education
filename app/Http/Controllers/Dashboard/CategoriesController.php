<?php namespace Education\Http\Controllers\Dashboard;

use Education\Http\Controllers\Controller;
use Education\Http\Requests\Categories\CreateRequest;
use Education\Http\Requests\Categories\EditRequest;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;

use Education\Entities\Category;
use Flash;

class CategoriesController extends Controller {
	
	private $category;
	private $form_data;

	private static $prefixRoute = 'categories.';
    private static $prefixView  = 'dashboard.pages.companies.users.categories.';

	public function __construct() 
	{
		$this->beforeFilter('@newCategory', ['only' => ['create', 'store']]);
		$this->beforeFilter('@findCategory', ['only' => ['show', 'edit', 'update']]);	
	}

	/**
	 * Create a new Category
	 *
	 * @return void
	 */
	public function newCategory()
	{
		$this->category = new Category;
	}

	/**
	 * Find the Category or App Abort 404
	 *
	 * @return void
	 */
	public function findCategory(Route $route)
	{
	 	$this->category = Category::findOrFail($route->getParameter('categories'));
	} 

	/**
	 * Return the default Form View for Companies
	 *
	 * @return void
	 */
	public function getFormView($viewName = 'form')
	{
	 	return view(self::$prefixView . $viewName)
			->with(['form_data' => $this->form_data, 'category' => $this->category]);
	} 

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function index()
	{
		return view()->make(self::$prefixView . 'list');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{		
		$this->form_data = ['route' => self::$prefixRoute . 'store', 'method' => 'POST'];
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

        Flash::info('Categoria creada correctamente');

        return redirect()->route(self::$prefixRoute . 'index');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return view()->make(self::$prefixView . 'show');
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$this->form_data = ['route' => [self::$prefixRoute . 'update', $this->category->id], 'method' => 'PUT', 'files' => true];
		return $this->getFormView();
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(EditRequest $request, $id)
	{
        $this->category->fill($request->all());        
        $this->category->save();
        
        return redirect()->route(self::$prefixRoute . 'index');

	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
    {    	
        $this->category->delete();

        if (request()->ajax())
        {
            return response()->json([
                'success' => true,
                'msg'     => 'Categoría "' . $this->category->name . '" eliminada',
                'id'      => $this->category->id
            ]);
        }
        else
        {
            return redirect()->route(self::$prefixRoute . 'index');
        }
	}
}
