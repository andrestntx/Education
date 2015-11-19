<?php namespace Education\Http\Controllers\Dashboard\Checklists;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Education\Http\Controllers\Controller;
use Education\Entities\format;
use Education\Entities\Checklist;
use Education\Http\Requests\Checklists\CreateRequest;
use Auth, Flash;

class ChecklistsController extends Controller
{
	private $format;
	private $checklist;

    private static $prefixRoute = 'checklists.';
    private static $prefixView  = 'dashboard.pages.companies.users.formats.checklists.';

	public function __construct() 
	{
		$this->beforeFilter('@findFormat');	
		$this->beforeFilter('@validateChecklist', ['only' => ['create']]);
		$this->beforeFilter('@newChecklist', ['only' => ['create', 'store']]);
	}

		/**
	 * Find the Protocol or App Abort 404
	 *
	 * @return void
	 */
	public function findFormat(Route $route)
	{
	 	$this->format = Format::findOrFail($route->getParameter('formats'));
	} 

	/**
	 * Validate the conditions for a new Exam
	 *
	 * @return void
	 */
	public function validateChecklist()
	{
		if( ! $this->format->aviable || $this->format->questions->count() == 0)
		{
			Flash::warning('Examen de Protocolo no disponible');
			return redirect()->route('study', $this->format->id);
		}
	}

	/**
	 * Create a new Exam
	 *
	 * @return void
	 */
	public function newChecklist()
	{
		$this->checklist = new Checklist;
	}

	public function studyProtocol($protocol_id)
	{
        return view(self::$prefixView .'study')
			->with(['user' => Auth::user(), 'format' => $this->format]);
	}

	public function create($protocol_id)
	{				
		$this->format->load('questions');
		$form_data = ['route' => ['checklists.store', $this->format->id], 'method' => 'POST'];

        return view(self::$prefixView .'form', compact('form_data'))
			->with(['checklist' => $this->checklist, 'format' => $this->format]);
	}

	public function store(CreateRequest $request, $protocol_id)
	{
        $this->checklist->fill($request->all());
        $this->checklist->format_id = $this->format->id;
        $this->checklist->user_id   = Auth::user()->id;
        $this->checklist->save();
		$this->checklist->answers()->attach($request->get('answers'));

		Flash::info('Lista de chequeo guardada correctamente');

		return redirect()->route(self::$prefixRoute .'show', $this->format->id);
	}

    public function show()
    {
        $user = Auth::user();
        $checklists = $this->format->getUserChecklists($user);
        return view(self::$prefixView . 'list')
            ->with(['checklists' => $checklists,'format' => $this->format]);
    }
}

?>