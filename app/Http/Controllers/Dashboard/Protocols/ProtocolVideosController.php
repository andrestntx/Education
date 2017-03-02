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
    private static $prefixRoute = 'protocols.videos.';
    private static $prefixView = 'dashboard.pages.companies.users.protocols.videos.';

    public function getViewForm($viewName = 'form', array $data = array())
    {
        return view(self::$prefixView.$viewName)
            ->with(['protocol' => $this->protocol, 'video' => $this->video, 'form_data' => $this->form_data] + $data);
    }

    public function create($protocol_id)
    {
        $this->form_data = ['route' => [self::$prefixRoute.'store', $this->protocol->id], 'method' => 'POST'];
        return $this->getViewForm('form');
    }

    public function store(Request $request)
    {
        $this->video->fill($request->all());        
        $this->protocol->links()->save($this->video);

        return ['success' => true, 'message' => 'Video guardado correctamente'];
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $this->form_data = ['route' => [self::$prefixRoute.'update', $this->protocol->id, $this->video->id], 'method' => 'PUT'];
        return $this->getViewForm('form');
    }

    public function update(Request $request, $id)
    {
        $this->video->fill($request->all());   
        $this->video->save();     

        return ['success' => true, 'message' => 'Video actualizado correctamente'];
    }

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
