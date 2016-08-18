<?php

namespace Education\Entities;

use Illuminate\Database\Eloquent\Model;

class GeneratedProtocol extends Model
{
	protected $fillable = ['title', 'generator_id', 'user_id'];

    /**
     * @return $this
     */
    public function questions()
    {
        return $this->belongsToMany(Question::class, 'generated_protocol_question', 'protocol_id', 'question_id')->withPivot('answer');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function generator()
    {
        return $this->belongsTo(Generator::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return mixed
     */
    public function questionsKeyById()
    {
    	return $this->questions->keyBy('id')->all();
    }

    /**
     * @param $questionId
     * @return mixed
     */
    public function getAnswerQuestion($questionId)
    {
    	if($this->exists && array_key_exists($questionId, $this->questionsKeyById())){
    		return $this->questionsKeyById()[$questionId]->pivot->answer;	
    	}
    }
}
