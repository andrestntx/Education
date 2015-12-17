<?php

namespace Education\Entities;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Exam extends Model
{
    protected $fillable = array('user_id', 'protocol_id');
    public $timestamps = true;
    public $increments = true;
    public $errors;

    public function getNumberQuestionsAttribute()
    {
        return $this->questions->count();
    }

    public function getCreatedAtHummansAttribute()
    {
        Carbon::setLocale('es');

        return ucfirst($this->created_at->diffForHumans());
    }

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

    public function isUser($user)
    {
        if ($this->user_id == $user) {
            return true;
        }

        return false;
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
