<?php
namespace Education\Http\Controllers\Dashboard\Protocols;

use Education\Repositories\ForumRepository;
use Illuminate\Routing\Route;
use Education\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Education\Http\Requests\Protocols\CreateRequest;
use Education\Http\Requests\Protocols\EditRequest;
use Education\Entities\Protocol;
use Auth;
use Storage;
use File;
use Flash;

class ProtocolsController extends Controller
{
    private $protocol;
    private $form_data;
    private $forumRepository;

    private static $prefixRoute = 'protocols.';
    private static $prefixView = 'dashboard.pages.companies.users.protocols.';

    public function __construct(ForumRepository $forumRepository)
    {
        $this->beforeFilter('@newProtocol', ['only' => ['create', 'store']]);
        $this->beforeFilter('@findProtocol', ['only' => ['show', 'edit', 'update', 'destroy']]);
        $this->forumRepository = $forumRepository;
    }

    /**
     * Create a new Company.
     */
    public function newProtocol()
    {
        $this->protocol = new Protocol();
    }

    /**
     * Find the Company or App Abort 404.
     */
    public function findProtocol(Route $route)
    {
        $this->protocol = Protocol::findOrFail($route->getParameter('protocols'));
    }

    /**
     * Return the default Form View for Companies.
     */
    public function getFormView($viewName = 'form')
    {
        return view(self::$prefixView.$viewName)
            ->with(['form_data' => $this->form_data, 'protocol' => $this->protocol]);
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
        $this->protocol->fillAndClear($request->all());
        Auth::user()->protocolsCreated()->save($this->protocol);

        $this->protocol->syncRelations($request->all());
        $this->protocol->uploadDoc($request->file('file_doc'));
        $this->protocol->save();
        Flash::info('Protocolo '.$this->protocol->name.' Guardado correctamente');

        return redirect()->route(self::$prefixRoute.'show', $this->protocol);
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
        $forums = $this->forumRepository->paginateOfProtocol($this->protocol);
        $this->protocol->load('Links', 'questions');

        return view(self::$prefixView.'show-admin')->with([
            'protocol' => $this->protocol,
            'forums' => $forums
        ]);
    }

    public function stats($id)
    {
        $protocol = Protocol::findOrFail($id);
        $users = User::with(array('examScores' => function ($query) use ($protocol) {
            $query->whereSurveyId($protocol->survey_id);

        }, ))->canStudyProtocol($protocol->id)->get();

        return view()->make('dashboard.pages.protocol.exams', compact('protocol', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $this->form_data = ['route' => [self::$prefixRoute.'update', $this->protocol->id], 'method' => 'PUT', 'files' => true];

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
        $this->protocol->uploadDoc($request->file('file_doc'));
        $this->protocol->fillAndClear($request->all());
        $this->protocol->save();
        $this->protocol->syncRelations($request->all());
        Flash::info('Protocolo '.$this->protocol->name.' Actualizado correctamente');

        return redirect()->route(self::$prefixRoute.'show', $this->protocol);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $data = [
            'success' => true,
            'message' => 'Protocolo eliminado correctamente'
        ];   

        if($this->protocol->exams()->count() == 0){
            try {
                $this->protocol->detachAndDelete();
            } catch (QueryException $e) {
                $data['success'] = false;
                $data['message'] = 'El Protocolo no se puede eliminar';
            }    
        }
        else{
            $data['success'] = false;
            $data['message'] = 'El Protocolo no se puede eliminar, ya que tiene examenes asociados';
        }

        return response()->json($data);
    }

}
