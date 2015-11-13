<?php namespace Education\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Education\Http\Controllers\Controller;
use Education\Http\Requests\Areas\CreateRequest;
use Education\Http\Requests\Areas\EditRequest;
use Flash, Alert;

use Education\Entities\Area;

class AreasController extends Controller {

    private $area;
    private $form_data;
    private static $prefixRoute = 'areas.';
    private static $prefixView = 'dashboard.pages.companies.users.areas.';

    public function __construct()
    {
        $this->beforeFilter('@newArea', ['only' => ['store','create']]);
        $this->beforeFilter('@findArea', ['only' => ['show', 'edit', 'update', 'destroy']]);
    }

    /**
     * Find a specified resource
     *
     */
    public function findArea(Route $route)
    {
        $this->area = Area::findOrFail($route->getParameter('areas'));
    }

    /**
     * Create a new User instance
     *
     */
    public function newArea()
    {
        $this->area = new Area;
    }

    public function getViewForm($viewName = 'show')
    {
        return view(self::$prefixView . $viewName)
            ->with(['area' => $this->area, 'form_data' => $this->form_data]);
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return view(self::$prefixView . 'list');
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $this->form_data = ['route' => self::$prefixRoute .'store', 'method' => 'POST'];
        return $this->getViewForm('form');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateRequest $request)
	{
        $this->area->fill($request->all());
        \Auth::user()->areasCreated()->save($this->area);

        Flash::info('Area '.$this->area->name.' Guardada correctamente');

        return redirect()->route(self::$prefixRoute .'index');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return $this->getViewForm();
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $this->form_data = ['route' => [self::$prefixRoute . 'update', $this->area->id], 'method' => 'PUT', 'files' => true];
        return $this->getViewForm('form');
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(EditRequest $request, $id)
	{
        $this->area->fill($request->all());
        $this->area->save();

        Flash::info('Area '.$this->area->name.' Actualizada correctamente');

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
        $this->area->delete();

        if (Request::ajax())
        {
            return Response::json(array (
                'success' => true,
                'msg'     => 'Área "' . $this->area->name . '" eliminada',
                'id'      => $this->area->id
            ));
        }
        else
        {
            return Redirect::route('areas.index');
        }
	}
}
