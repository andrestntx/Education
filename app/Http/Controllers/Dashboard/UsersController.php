<?php namespace Education\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Education\Http\Controllers\Controller;
use Education\Http\Requests\Users\CreateRequest;
use Education\Http\Requests\Users\EditRequest;
use Education\Entities\User;
use Flash, Alert;

class UsersController extends Controller {

    private $user;
    private $form_data;
    private static $prefixRoute = 'users.';
    private static $prefixView = 'dashboard.pages.companies.users.admin.';

    public function __construct()
    {
        $this->beforeFilter('@newUser', ['only' => ['store','create']]);
        $this->beforeFilter('@findUser', ['only' => ['show', 'edit', 'update', 'destroy']]);
    }

    /**
     * Find a specified resource
     *
     */
    public function findUser(Route $route)
    {
        $this->user = User::findOrFail($route->getParameter('users'));
    }
    /**
     * Create a new User instance
     *
     */
    public function newUser()
    {
        $this->user = new User;
    }

    public function getViewForm($viewName = 'form')
    {
        return view(self::$prefixView . $viewName)
            ->with(['user' => $this->user, 'form_data' => $this->form_data]);
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
        $this->form_data = ['route' => self::$prefixRoute .'store', 'method' => 'POST', 'files' => true];
        return $this->getViewForm();
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */

	public function store(CreateRequest $request)
	{
        $this->user->fill($request->all());
        \Auth::user()->company->users()->save($this->user);
        $this->user->syncRelations($request->all());
        $this->user->uploadImage($request->file('url_photo'));

        Flash::info('Usuario '.$this->user->name.' Guardado correctamente');

        return redirect()->route(self::$prefixRoute .'index');
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $this->form_data = ['route' => [self::$prefixRoute . 'update', $this->user->id], 'method' => 'PUT', 'files' => true];
        return $this->getViewForm('form');
	}



	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(EditRequest $request)
	{
        $this->user->fill($request->all());
        $this->user->save();
        $this->user->syncRelations($request->all());
        $this->user->uploadImage($request->file('url_photo'));

        Flash::info('Usuario '.$this->user->name.' Actualizado correctamente');

        return redirect()->route(self::$prefixRoute . 'index');
	}

    public function scores($id)
    {
        $user = User::findOrFail($id);

        $protocols = Protocol::with(array('examScores' => function($query) use($user)
            {
                $query->whereUserId($user->id);

            }))->userCanStudy($user->id)->get();

        return View::make('dashboard.pages.user.scores', compact('protocols','user'));
    }


	public function updateProfile($id)
	{
		$user = User::findOrFail($id);
        $image = Input::file('url_photo');
        $data = Input::all();

        if ($user->validAndSave($data, $image))
        {
            return Redirect::to('mi-perfil');
        }
        else
        {
        	return Redirect::intended('mi-perfil')->withErrors($user->errors);
        }	
	}

	public function profile()
	{
		$user = Auth::user();
		$form_data = array('route' => array('usuarios.update-profile', $user->id), 'method' => 'POST', 'files' => true);
		$number_protocols = $user->protocolsForStudy()->count();
		$number_exams = $user->examScores()->count();
		
		return View::make('dashboard.pages.user.profile', compact('user', 'form_data', 'number_protocols', 'number_exams'));
	}
}
