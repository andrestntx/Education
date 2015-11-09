<?php namespace Education\Http\Controllers\Dashboard;

use Education\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;

use Education\Entities\Company;

class CompaniesController extends Controller {

	private $company;
	private $form_data;

	public function __construct() 
	{
		$this->beforeFilter('@newCompany', ['only' => ['create', 'store']]);
		$this->beforeFilter('@findCompany', ['only' => ['show', 'edit', 'update']]);
	}

	/**
	 * Create a new Company
	 *
	 * @return void
	 */
	public function newCompany()
	{
		$this->company = new Company;
	}

	/**
	 * Find the Company or App Abort 404
	 *
	 * @return void
	 */
	public function findCompany(Route $route)
	{
	 	$this->company = Company::findOrFail($route->getParameter('companies'));
	} 

	/**
	 * Return the default Form View for Companies
	 *
	 * @return void
	 */
	public function getFormView()
	{
	 	return view('dashboard.pages.company.form')
			->with(['form_data' => $this->form_data, 'company' => $this->company]);
	} 

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function index()
	{
		$companies = Company::whereTypeId('2')->orderBy('id')->paginate(10);
		return view('dashboard.pages.company.lists', compact('companies'));
		
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->form_data = ['route' => 'companies.store', 'method' => 'POST', 'files' => true];
		return $this->getFormView();
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->company->fill($request->all());
        $this->company->save();

        return redirect()->route('companies.index');

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return view('dashboard.pages.company.show')->with('company', $this->company);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit()
	{
		$this->form_data = ['route' => ['companies.update', $this->company->id], 'method' => 'PUT', 'files' => true];
		return $this->getFormView();
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$this->company->fill($request->all());
        $this->company->save();

        return redirect()->route('companies.index');
	}

}
