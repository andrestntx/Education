<?php namespace Education\Http\Controllers\Dashboard;

use Education\Entities\Protocol;
use Education\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;

use Education\Entities\Annex;

class ProtocolAnnexesController extends Controller {

    private $annex;
    private $protocol;
    private $form_data;
    private static $prefixRoute = 'protocols.annexes.';
    private static $prefixView  = 'dashboard.pages.models.';

    public function __construct()
    {
        $this->beforeFilter('@newAnnex', ['only' => ['create', 'store']]);
        $this->beforeFilter('@findAnnex', ['only' => ['show', 'edit', 'update', 'destroy']]);
        $this->beforeFilter('@findProtocol');
    }

    /**
     * Find a specified resource
     *
     */
    public function findAnnex(Route $route)
    {
        $this->annex = Annex::findOrFail($route->getParameter('annexes'));
    }

    /**
     * Find a specified resource
     *
     */
    public function findProtocol(Route $route)
    {
        $this->protocol = Protocol::findOrFail($route->getParameter('protocols'));
    }

    /**
     * Create a new Annex instance
     *
     */
    public function newAnnex()
    {
        $this->annex = new Annex;
    }

    /**
     * Get de thefault view Form
     *
     */
    public function getViewForm($viewName = 'show')
    {
        return view(self::$prefixView . $viewName)
            ->with(['protocol' => $this->protocol, 'annex' => $this->annex, 'form_data' => $this->form_data]);
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */


	public function index($protocol_id)
	{
		//$protocol = Protocol::findOrFail($protocol_id);
		//$annex = $protocol->annex()->orderBy('id')->paginate(20);

		//return View::make('dashboard.pages.anexos.lists-table', compact('annex', 'protocol')); 
		return Redirect::route('protocols.show', $protocol_id);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($protocol_id, $annex_id)
	{
        $this->form_data = ['route' => [self::$prefixRoute . 'store', $this->protocol->id], 'method' => 'POST', 'files' => true];
        return $this->getViewForm('create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */

    public function store(CreateRequest $request, $doc)
    {
        $this->annex->fill($request->all());
        $this->annex = $this->protocol->annexes()->save($this->annex);

        Flash::info('Anexo guardado correctamente');

        return redirect()->route('protocols.show', $this->protocol->id);
    }
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($protocol_id, $annex_id)
	{
        return $this->getViewForm();
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($protocol_id, $id)
	{
        $this->form_data = ['route' => [self::$prefixRoute . 'update', $this->protocol->id, $this->annex->id], 'method' => 'PUT', 'files' => true];
        return $this->getViewForm('form');
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update(EditRequest $request, $protocol_id, $annex_id)
    {
        $this->annex->fill($request->all());
        $this->protocol->annexes()->save($this->annex);

        Flash::info('Anexo actualizado correctamente');

        return redirect()->route('protocols.show', $this->protocol->id);
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($protocol_id, $id)
	{
    	$annex = Annex::findOrFail($id);
        $annex->delete();

        if (Request::ajax())
        {
            return Response::json(array (
                'success' => true,
                'msg'     => 'Protocolo "' . $annex->name . '" eliminado',
                'id'      => $annex->id
            ));
        }
        else
        {
            return Redirect::route('protocolos.anexos.index', $protocol_id);
        }
	}


}
