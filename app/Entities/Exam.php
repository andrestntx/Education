<?php

namespace Education\Entities;

use Carbon\Carbon;

class Exam extends MyModel
{
    protected $fillable = array('user_id', 'protocol_id');
    public $timestamps = true;
    public $increments = true;
    public $errors;

    /**
    * Accesors
    */
    public function getNumberQuestionsAttribute()
    {
        return $this->questions->count();
    }

     public function getCorrectAnswersAttribute()
    {
        return $this->answers->where('correct', '1');
    }

    public function getIncorrectAnswersAttribute()
    {
        return $this->answers->where('correct', '0');
    }

    public function getCountCorrectAnswersAttribute()
    {
        return $this->correct_answers->count();
    }

    public function getCountIncorrectAnswersAttribute()
    {
        return $this->incorrect_answers->count();
    }

    public function getCountAnswersAttribute()
    {
        return $this->answers->count();
    }

    public function getScoreAttribute()
    {
        if ($this->count_answers > 0) {
            return number_format(($this->count_correct_answers / $this->count_answers) * 100, 2);
        }

        return 'NA';
    }

    /**
    * Relations
    */
    public function answers()
    {
        return $this->belongsToMany(Answer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function protocol()
    {
        return $this->belongsTo(Protocol::class);
    }

   
    /**
    * Functions
    */
    public function isScoreOk()
    {
        if ($this->score >= env('APP_MIN_EXAM_SCORE', 80) && $this->created_at->diffInDays(Carbon::now()) <= env('APP_MAX_DAY_EXAM', 30)) {
            return true;
        }

        return false;
    }

    public function isPending()
    {
        return !$this->isScoreOk();
    }
}
