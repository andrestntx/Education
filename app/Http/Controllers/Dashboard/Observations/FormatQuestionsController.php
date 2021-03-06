<?php

namespace Education\Http\Controllers\Dashboard\Observations;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Education\Http\Controllers\Controller;
use Education\Http\Requests\Questions\CreateRequest;
use Education\Http\Requests\Questions\EditRequest;
use Education\Entities\ObservationFormat;
use Education\Entities\Question;
use Education\Entities\Answer;
use Flash;

class FormatQuestionsController extends Controller
{
    private $format;
    private $question;
    private $form_data;

    private static $prefixRoute = 'formats.observations.questions.';
    private static $prefixView = 'dashboard.pages.companies.users.formats.observations.questions.';

    public function __construct()
    {
        $this->beforeFilter('@newQuestion', ['only' => ['create', 'store']]);
        $this->beforeFilter('@findFormat');
        $this->beforeFilter('@findQuestion', ['only' => ['show', 'edit', 'update']]);
    }

    /**
     * Create a new Format.
     */
    public function newQuestion()
    {
        $this->question = new Question();
    }

    /**
     * Find the Format or App Abort 404.
     */
    public function findFormat(Route $route)
    {
        $this->format = ObservationFormat::findOrFail($route->getParameter('observations'));
    }

    /**
     * Find the Question of Format or App Abort 404.
     */
    public function findQuestion(Route $route)
    {
        $this->question = $this->format->questions()->findOrFail($route->getParameter('questions'));
    }

    /**
     * Return the default Form View for Companies.
     */
    public function getFormView($number_answers = 2, $viewName = 'form')
    {
        return view(self::$prefixView.$viewName)
            ->with(['form_data' => $this->form_data, 'format' => $this->format, 'question' => $this->question,
                'number_answers' => $number_answers,
            ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($format_id)
    {
        return redirect()->route('formats.observations.show', $format_id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request, $format_id)
    {
        $this->form_data = ['route' => [self::$prefixRoute.'store', $this->format->id], 'method' => 'POST'];

        return $this->getFormView($request->get('answers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(CreateRequest $request, $format_id)
    {
        $this->question->fill($request->all());
        $this->question->order = $this->format->orderNewQuestion();
        $this->format->questions()->save($this->question);

        $answers = $request->get('answers');
        $newAnswers = [];

        foreach ($answers as $answer) {
            array_push($newAnswers, new Answer($answer));
        }

        $this->question->answers()->saveMany($newAnswers);

        Flash::info('Pregunta  Guardada correctamente');

        return redirect()->route('formats.observations.show', $this->format->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($format_id, $question_id)
    {
        $this->form_data = ['route' => [self::$prefixRoute.'update', $this->format->id, $this->question->id], 'method' => 'PUT'];

        return $this->getFormView();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update(EditRequest $request, $format_id, $question_id)
    {
        $this->question->fill($request->all());
        $this->question->save();

        $answers = $request->get('answers');

        foreach ($answers as $id => $answer) {
            Answer::findOrFail($id)->fill($answer)->save();
        }

        Flash::info('Pregunta  Actualizada correctamente');

        return redirect()->route('formats.observations.show', $this->format->id);
    }

    public function order(Request $request)
    {
        $questions = $request->get('questions');

        foreach ($questions as $order => $question_id) {
            $question = $this->format->questions()->findOrFail($question_id);
            $question->order = $order + 1;
            $question->save();
        }

        return ['success' => true];
    }
}
