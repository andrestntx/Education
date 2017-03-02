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

    public function store(Request $request, Protocol $protocol)
    {
        $file = $request->file('file');
        $name = $file->getClientOriginalName();

        Storage::disk('local')->put(
            'protocols/'.$this->protocol->id.'/annexes/'.$name,
            File::get($file)
        );

        return 'file saved';
    }

    public function destroy(Protocol $protocol, $fileName)
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
