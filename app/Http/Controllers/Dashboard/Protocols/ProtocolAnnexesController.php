<?php

namespace Education\Http\Controllers\Dashboard\Protocols;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Education\Http\Controllers\Controller;
use Education\Entities\Protocol;
use Storage, File, Flash;

class ProtocolAnnexesController extends Controller
{
    private $protocol;
    private $form_data;

    public function __construct()
    {
        $this->beforeFilter('@findProtocol');
    }

    /**
     * Find a specified resource.
     */
    public function findProtocol(Route $route)
    {
        $this->protocol = Protocol::findOrFail($route->getParameter('protocols'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request, $protocol_id)
    {
        $file = $request->file('file');
        $name = $file->getClientOriginalName();

        Storage::disk('local')->put(
            'protocols/'.$this->protocol->id.'/annexes/'.$name,
            File::get($file)
        );

        return 'file saved';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($protocol_id, $fileName)
    {
        if (Storage::has($this->protocol->getPathAnnexes().$fileName)) {
            Storage::delete($this->protocol->getPathAnnexes().$fileName);
            Flash::info('Anexo '.$fileName.' Eliminado correctamente');
        } else {
            Flash::error('Anexo '.$fileName.' no existe');
        }

        return redirect()->route('protocols.show', $this->protocol->id);
    }
}
