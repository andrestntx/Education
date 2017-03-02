<?php

namespace Education\Http\Controllers\Dashboard\Observations;

use Illuminate\Routing\Route;
use Education\Http\Controllers\Controller;
use Education\Http\Requests\Formats\CreateRequest;
use Education\Http\Requests\Formats\EditRequest;
use Education\Entities\ObservationFormat;
use Auth;
use Storage;
use Flash;

class FormatsController extends Controller
{
    private static $prefixRoute = 'formats.observations.';
    private static $prefixView = 'dashboard.pages.companies.users.formats.observations.format.';

    /**
     * Return the default Form View for Companies.
     */
    public function getFormView($viewName = 'form')
    {
        return view(self::$prefixView.$viewName)
            ->with(['form_data' => $this->form_data, 'format' => $this->format]);
    }

    public function index()
    {
        return view(self::$prefixView.'list');
    }


    public function create()
    {
        $this->form_data = ['route' => self::$prefixRoute.'store', 'method' => 'POST'];

        return $this->getFormView();
    }


    public function store(CreateRequest $request)
    {
        $this->format->fillAndClear($request->all());
        Auth::user()->formatsCreated()->save($this->format);

        $this->format->syncRelations($request->all());
        $this->format->save();

        Flash::info('Formato '.$this->format->name.' Guardado correctamente');

        return redirect()->route(self::$prefixRoute.'show', $this->format);
    }

    public function show($id)
    {
        $this->format->load(['questions' => function ($query) {
            $query->orderBy('order', 'asc');
        }]);

        return view(self::$prefixView.'show')->with('format', $this->format);
    }


    public function edit($id)
    {
        $this->form_data = ['route' => [self::$prefixRoute.'update', $this->format->id], 'method' => 'PUT'];

        return $this->getFormView();
    }


    public function update(EditRequest $request, $id)
    {
        $this->format->fillAndClear($request->all());
        $this->format->save();
        $this->format->syncRelations($request->all());

        Flash::info('Formato '.$this->format->name.' Actualizado correctamente');

        return redirect()->route(self::$prefixRoute.'show', $this->format);
    }


    public function destroy($id)
    {
        $data = [
            'success' => true,
            'message' => 'Formato eliminado correctamente'
        ];   

        if($this->format->observations()->count() == 0){
            try {
                $this->format->detachAndDelete();
            } catch (QueryException $e) {
                $data['success'] = false;
                $data['message'] = 'El Formato no se puede eliminar';
            }    
        }
        else{
            $data['success'] = false;
            $data['message'] = 'El Formato no se puede eliminar, ya que algún usuario lo ha diligenciado';
        }

        return response()->json($data);
    }
}
