<?php

namespace Education\Http\Controllers\Dashboard\Protocols;

use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use Education\Entities\Link;
use Education\Entities\Protocol;
use Education\Http\Controllers\Controller;
use Education\Http\Requests\Links\CreateRequest;
use Education\Http\Requests\Links\EditRequest;
use Vinkla\Vimeo\Facades\Vimeo;
use Illuminate\Database\QueryException;

class ProtocolVideosController extends Controller
{
    private $video;
    private $protocol;
    private $form_data;
    private static $prefixRoute = 'protocols.videos.';
    private static $prefixView = 'dashboard.pages.companies.users.protocols.videos.';

    public function __construct()
    {
        $this->beforeFilter('@newVideo', ['only' => ['create', 'store']]);
        $this->beforeFilter('@findVideo', ['only' => ['show', 'edit', 'update', 'destroy']]);
        $this->beforeFilter('@findProtocol');
    }

    /**
     * Find a specified resource.
     */
    public function findVideo(Route $route)
    {
        $this->video = Link::findOrFail($route->getParameter('videos'));
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
    public function newVideo()
    {
        $this->video = new Link();
        $this->video->type = 'vimeo';
    }

    /**
     * Get de thefault view Form.
     */
    public function getViewForm($viewName = 'form', array $data = array())
    {
        return view(self::$prefixView.$viewName)
            ->with(['protocol' => $this->protocol, 'video' => $this->video, 'form_data' => $this->form_data] + $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($protocol_id)
    {
        $this->form_data = ['route' => [self::$prefixRoute.'store', $this->protocol->id], 'method' => 'POST'];
        return $this->getViewForm('form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->video->fill($request->all());        
        $this->protocol->links()->save($this->video);

        return ['success' => true, 'message' => 'Video guardado correctamente'];
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
        $this->form_data = ['route' => [self::$prefixRoute.'update', $this->protocol->id, $this->video->id], 'method' => 'PUT'];
        return $this->getViewForm('form');
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
        $this->video->fill($request->all());   
        $this->video->save();     

        return ['success' => true, 'message' => 'Video actualizado correctamente'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $request = Vimeo::request('/videos/' . $this->video->getVimeoId(), [], 'DELETE');

        if($request['status'] != 204) {
            \Log::info('Verificar DELETE video ' . $this->video->getVimeoId() . 'en vimeo');
        }

        try {
            $this->video->delete();
            \Flash::info('Video eliminado correctamente'); 
        } catch (QueryException $e) {
            \Flash::danger('El video no se pudo eliminar');
        } 

        return redirect()->route('protocols.show', $this->protocol); 
    }
}
