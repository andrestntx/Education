<?php
namespace Education\Http\Controllers\Dashboard;

use Education\Repositories\ForumRepository;
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
    private $forumRepository;

    public function __construct(ForumRepository $forumRepository)
    {
        $this->forumRepository = $forumRepository;
    }

    public function validateExam()
    {
        if (!$this->protocol->aviable || $this->protocol->questions->count() == 0) {
            Flash::warning('Examen de Protocolo no disponible');

            return redirect()->route('study', $this->protocol->id);
        }
    }

    public function studyProtocol(Protocol $protocol)
    {
        $forums = $this->forumRepository->paginateOfProtocol($protocol);

        return view()->make('dashboard.pages.companies.users.protocols.study')
            ->with([
                'user' => Auth::user(),
                'protocol' => $protocol,
                'forums' => $forums
            ]);
    }

    public function create(Protocol $protocol)
    {
        $exam = new Exam;
        $protocol->load('questions');
        $formData = ['route' => ['exams.store', $protocol->id], 'method' => 'POST'];

        return view('dashboard.pages.companies.users.protocols.exams.form', compact('formData'))
            ->with(['exam' => $exam, 'protocol' => $protocol]);
    }

    public function store(Request $request, Protocol $protocol)
    {
        $exam = Exam::create(['protocol_id' => $protocol->id, 'user_id' => Auth::user()->id]);
        $exam->answers()->attach($request->get('answers'));

        Flash::info('Examen evaluado correctamente');

        return redirect()->route('study', $protocol->id);
    }
}
