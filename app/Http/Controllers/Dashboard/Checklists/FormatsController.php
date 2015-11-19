<?php

namespace Education\Http\Controllers\Dashboard\Checklists;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Education\Http\Controllers\Controller;
use Education\Http\Requests\Protocols\CreateRequest;
use Education\Http\Requests\Protocols\EditRequest;
use Education\Entities\Protocol;
use Auth, Storage, File, Flash;

class FormatsController extends Controller
{
    private $format;
    private $form_data;

    private static $prefixRoute = 'formats.';
    private static $prefixView  = 'dashboard.pages.companies.users.formats.checklists.';

    public function __construct()
    {
        $this->beforeFilter('@newFormat', ['only' => ['create', 'store']]);
        $this->beforeFilter('@findFormat', ['only' => ['show', 'edit', 'update']]);
    }

    /**
     * Create a new Company
     *
     * @return void
     */
    public function newFormat()
    {
        $this->format = new Protocol;
    }

    /**
     * Find the Company or App Abort 404
     *
     * @return void
     */
    public function findFormat(Route $route)
    {
        $this->format = Protocol::findOrFail($route->getParameter('formats'));
    }

    /**
     * Return the default Form View for Companies
     *
     * @return void
     */
    public function getFormView($viewName = 'form')
    {
        return view(self::$prefixView . $viewName)
            ->with(['form_data' => $this->form_data, 'format' => $this->format]);
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
        $this->form_data = ['route' => self::$prefixRoute . 'store', 'method' => 'POST', 'files' => true];
        return $this->getFormView();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateRequest $request)
    {
        $this->format->fillAndClear($request->all());
        Auth::user()->protocolsCreated()->save($this->format);

        $this->format->syncRelations($request->all());
        $this->format->uploadDoc($request->file('file_doc'));
        $this->format->save();
        Flash::info('Protocolo '.$this->format->name.' Guardado correctamente');
        return redirect()->route(self::$prefixRoute . 'show', $this->format);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $this->format->load('Links', 'questions');
        return view(self::$prefixView . 'show-admin')->with('format', $this->format);
    }

    public function stats($id)
    {
        $format = Protocol::findOrFail($id);
        $users = User::with(array('examScores' => function($query) use($format)
            {
                $query->whereSurveyId($format->survey_id);

            }))->canStudyProtocol($format->id)->get();

        return view()->make('dashboard.pages.protocol.exams', compact('format', 'users'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $this->form_data = ['route' => [self::$prefixRoute . 'update', $this->format->id], 'method' => 'PUT', 'files' => true];
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
        $this->format->uploadDoc($request->file('file_doc'));
        $this->format->fillAndClear($request->all());
        $this->format->save();
        $this->format->syncRelations($request->all());
        Flash::info('Protocolo '.$this->format->name.' Actualizado correctamente');
        return redirect()->route(self::$prefixRoute . 'show', $this->format);
    }
}
