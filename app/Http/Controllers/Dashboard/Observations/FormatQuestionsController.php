<?php

namespace Education\Http\Controllers\Dashboard\Observations;

use Education\Entities\Format;
use Education\Http\Controllers\BaseResourceController;
use Education\Repositories\FormatRepository;
use Education\Repositories\QuestionRepository;
use Illuminate\Http\Request;
use Education\Http\Requests\Questions\CreateRequest;
use Education\Http\Requests\Questions\EditRequest;
use Education\Entities\Question;
use Flash;

class FormatQuestionsController extends BaseResourceController
{
    protected $formatRepository;
    protected $questionRepository;

    public function __construct(FormatRepository $formatRepository, QuestionRepository $questionRepository)
    {
        $this->formatRepository = $formatRepository;
        $this->questionRepository = $questionRepository;
    }

    public function index(Format $format)
    {
        return redirect()->route('formats.observations.show', $format);
    }

    public function create(Request $request, Format $format)
    {
        $formData = $this->getFormData('store', 'POST', false, $format);

        return $this->resourceView('form')->with([
            'form_data' => $formData,
            'format' => $format,
            'number_answers' => $request->get('answers', 2),
            'question' => new Question
        ]);
    }

    public function store(CreateRequest $request, Format $format)
    {
        $this->formatRepository->createQuestion($format, $request->all(), $request->get('answers'));
        $this->resourceFlash();

        return redirect()->route('formats.observations.show', $format);
    }

    public function edit(Request $request, Format $format, Question $question)
    {
        $formData = $this->getFormData('update', 'PUT', false, [$format, $question]);

        return $this->resourceView('form')->with([
            'form_data' => $formData,
            'format' => $format,
            'question' => $question,
            'number_answers' => $request->get('answers', 2)
        ]);
    }

    public function update(EditRequest $request, Format $format, Question $question)
    {
        $this->questionRepository->update($question, $request->all(), $request->get('answers'));
        $this->resourceFlash('', 'update');

        return redirect()->route('formats.observations.show', $format);
    }

    public function order(Request $request, Format $format)
    {
        $questions = $request->get('questions');

        foreach ($questions as $order => $question_id) {
            $question = $format->questions()->findOrFail($question_id);
            $question->order = $order + 1;
            $question->save();
        }

        return ['success' => true];
    }

    protected function getResourceEntity()
    {
        return Question::class;
    }
}
