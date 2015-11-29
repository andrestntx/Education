<?php

namespace Education\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Education\Http\Controllers\Controller;
use Education\Entities\Protocol;
use Education\Entities\User;
use Education\Entities\Exam;
use Auth;
use Flash;

class ExamsController extends Controller
{
    private $protocol;
    private $exam;

    public function __construct()
    {
        $this->beforeFilter('@findProtocol');
        $this->beforeFilter('@validateExam', ['only' => ['create']]);
        $this->beforeFilter('@newExam', ['only' => ['create', 'store']]);
    }

    /**
     * Find the Protocol or App Abort 404.
     */
    public function findProtocol(Route $route)
    {
        $this->protocol = Protocol::findOrFail($route->getParameter('protocols'));
    }

    /**
     * Validate the conditions for a new Exam.
     */
    public function validateExam()
    {
        if (!$this->protocol->aviable || $this->protocol->questions->count() == 0) {
            Flash::warning('Examen de Protocolo no disponible');

            return redirect()->route('study', $this->protocol->id);
        }
    }

    /**
     * Create a new Exam.
     */
    public function newExam()
    {
        $this->exam = new Exam();
    }

    public function studyProtocol($protocol_id)
    {
        return view()->make('dashboard.pages.companies.users.protocols.study')
            ->with(['user' => Auth::user(), 'protocol' => $this->protocol]);
    }

    public function create($protocol_id)
    {
        $this->protocol->load('questions');
        $form_data = ['route' => ['exams.store', $this->protocol->id], 'method' => 'POST'];

        return view('dashboard.pages.companies.users.protocols.exams.form', compact('form_data'))
            ->with(['exam' => $this->exam, 'protocol' => $this->protocol]);
    }

    public function store(Request $request, $protocol_id)
    {
        $this->exam = Exam::create(['protocol_id' => $this->protocol->id, 'user_id' => Auth::user()->id]);
        $this->exam->answers()->attach($request->get('answers'));

        Flash::info('Examen evaluado correctamente');

        return redirect()->route('study', $this->protocol->id);
    }
}
