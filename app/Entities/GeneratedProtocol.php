<?php

namespace Education\Entities;

use Illuminate\Database\Eloquent\Model;

class GeneratedProtocol extends Model
{

	protected $fillable = ['title'];

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'generated_protocol_question', 'protocol_id', 'question_id')->withPivot('answer');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function questionsKeyById()
    {
    	return $this->questions->keyBy('id')->all();
    }

    public function getAnswerQuestion($questionId)
    {
    	if($this->exists && array_key_exists($questionId, $this->questionsKeyById())){
    		return $this->questionsKeyById()[$questionId]->pivot->answer;	
    	}
    }
}
