<?php

/**
 * Created by PhpStorm.
 * User: andrestntx
 * Date: 8/4/16
 * Time: 9:32 PM
 */

namespace Education\Entities;

use Illuminate\Database\Eloquent\Model;


class Generator extends Model
{
    protected $fillable = ['title', 'company_id'];
    public $timestamps = true;
    public $increments = true;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function questions()
    {
        return $this->morphMany(Question::class, 'document');
    }

    /**
     * @return mixed
     */
    public function firstQuestions()
    {
        return $this->questions()
            ->with(['questions.questions.questions.questions.questions'])
            ->whereNull('superior_id')
            ->orderBy('order', 'asc')
            ->get();
    }

    /**
     * @return mixed
     */
    public function firstQuestionsAviable()
    {
        return $this->questions()
            ->with(['questions.questions.questions.questions.questions'])
            ->whereNull('superior_id')
            ->whereAviable(1)
            ->orderBy('order', 'asc')
            ->get();
    }

    /**
     * @return mixed
     */
    public function orderNewQuestion()
    {
        return $this->questions()->count() + 1;
    }

    /**
     * @param $question_id
     * @return mixed
     */
    protected function findQuestion($question_id)
    {
        return $this->questions()->findOrFail($question_id);
    }

    /**
     * @param $question_id
     * @param $order
     * @param null $superior_id
     * @return mixed
     */
    protected function setOrderQuestion($question_id, $order, $superior_id = null)
    {
        $question = $this->findQuestion($question_id);
        return $question->setOrder($order + 1, $superior_id);
    }

    /**
     * @param $superior_id
     * @param array $questions
     */
    protected function reorderChildrenQuestion($superior_id, array $questions)
    {
        foreach ($questions as $order => $questionJson) {
            $this->setOrderQuestionChildren($questionJson, $order, $superior_id);
        }
    }

    /**
     * @param $questionJson
     * @param $order
     * @param null $superior_id
     */
    protected function setOrderQuestionChildren($questionJson, $order, $superior_id = null)
    {
        $question = $this->setOrderQuestion($questionJson->id, $order, $superior_id);
        $this->reorderChildrenQuestion($question->id, $questionJson->children[0]);
    }

    /**
     * @param array $questions
     */
    public function reorderQuestions(array $questions)
    {
        foreach ($questions as $order => $questionJson) {
            $this->setOrderQuestionChildren($questionJson, $order);
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function generatedProtocols()
    {
        return $this->hasMany(GeneratedProtocol::class);
    }

}