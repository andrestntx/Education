<?php

namespace Education\Http\Controllers\Dashboard;

use Illuminate\Routing\Route;
use Education\Http\Controllers\Controller;
use Education\Http\Requests\Companies\CreateRequest;
use Education\Http\Requests\Companies\EditRequest;
use Education\Entities\Company;
use Flash;

class CompaniesController extends Controller
{
    private $company;
    private $form_data;

    private static $prefixRoute = 'companies.';
    private static $prefixView = 'dashboard.pages.companies.';

    public function __construct()
    {
        $this->beforeFilter('@newCompany', ['only' => ['create', 'store']]);
        $this->beforeFilter('@findCompany', ['only' => ['show', 'edit', 'update']]);
    }

    /**
     * Create a new Company.
     */
    public function newCompany()
    {
        $this->company = new Company();
    }

    /**
     * Find the Company or App Abort 404.
     */
    public function findCompany(Route $route)
    {
        $this->company = Company::findOrFail($route->getParameter('companies'));
    }

    /**
     * Return the default Form View for Companies.
     */
    public function getFormView($viewName = 'form')
    {
        return view(self::$prefixView.$viewName)
            ->with(['form_data' => $this->form_data, 'company' => $this->company]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view(self::$prefixView.'list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->form_data = ['route' => self::$prefixRoute.'store', 'method' => 'POST', 'files' => true];

        return $this->getFormView();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateRequest $request)
    {
        $this->company->fillAndClear($request->all());
        $this->company->save();
        $this->company->uploadLogo($request->file('url_logo'));
        Flash::info('Institución '.$this->company->name.' Guardada correctamente');

        return redirect()->route(self::$prefixRoute.'index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        return redirect()->route(self::$prefixRoute.'edit', $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit()
    {
        $this->form_data = ['route' => [self::$prefixRoute.'update', $this->company->id], 'method' => 'PUT', 'files' => true];

        return $this->getFormView();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update(EditRequest $request, $id)
    {
        $this->company->fillAndClear($request->all());
        $this->company->save();
        $this->company->uploadLogo($request->file('url_logo'));
        Flash::info('Institución '.$this->company->name.' Actualizado correctamente');

        return redirect()->route(self::$prefixRoute.'index');
    }
}
