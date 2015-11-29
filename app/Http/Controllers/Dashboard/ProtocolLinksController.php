<?php

namespace Education\Http\Controllers\Dashboard;

use Illuminate\Routing\Route;
use Education\Entities\Link;
use Education\Entities\Protocol;
use Education\Http\Controllers\Controller;
use Education\Http\Requests\Links\CreateRequest;
use Education\Http\Requests\Links\EditRequest;
use Flash;

class ProtocolLinksController extends Controller
{
    private $link;
    private $protocol;
    private $form_data;
    private static $prefixRoute = 'protocols.links.';
    private static $prefixView = 'dashboard.pages.companies.users.protocols.links.';

    public function __construct()
    {
        $this->beforeFilter('@newLink', ['only' => ['create', 'store']]);
        $this->beforeFilter('@findLink', ['only' => ['show', 'edit', 'update', 'destroy']]);
        $this->beforeFilter('@findProtocol');
    }

    /**
     * Find a specified resource.
     */
    public function findLink(Route $route)
    {
        $this->link = Link::findOrFail($route->getParameter('links'));
    }

    /**
     * Find a specified resource.
     */
    public function findProtocol(Route $route)
    {
        $this->protocol = Protocol::findOrFail($route->getParameter('protocols'));
    }

    /**
     * Create a new Annex instance.
     */
    public function newLink()
    {
        $this->link = new Link();
    }

    /**
     * Get de thefault view Form.
     */
    public function getViewForm($viewName = 'form')
    {
        return view(self::$prefixView.$viewName)
            ->with(['protocol' => $this->protocol, 'link' => $this->link, 'form_data' => $this->form_data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($protocol_id)
    {
        $this->form_data = ['route' => [self::$prefixRoute.'store', $this->protocol->id], 'method' => 'POST'];

        return $this->getViewForm();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateRequest $request)
    {
        $this->link->fill($request->all());
        $this->link = $this->protocol->links()->save($this->link);

        Flash::info('Link '.$this->link->name.' Guardado correctamente');

        return redirect()->route('protocols.show', $this->protocol->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($protocol_id, $id)
    {
        $this->form_data = ['route' => [self::$prefixRoute.'update', $this->protocol->id, $this->link->id], 'method' => 'PUT'];

        return $this->getViewForm('form');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update(EditRequest $request, $protocol_id, $id)
    {
        $this->link->fill($request->all());
        $this->link->save();

        Flash::info('Link '.$this->link->name.' Actualizado correctamente');

        return redirect()->route('protocols.show', $this->protocol->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($protocol_id, $id)
    {
        $name = $this->link->name;
        $this->link->delete();
        Flash::info('Link '.$name.' Eliminado correctamente');

        return redirect()->route('protocols.show', $this->protocol->id);
    }
}
