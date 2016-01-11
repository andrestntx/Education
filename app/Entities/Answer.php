<?php

namespace Education\Entities;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answers';
    protected $fillable = ['text', 'observation', 'correct'];
    public $timestamps = true;
    public $increments = true;
    public $errors;

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function exams()
    {
        return $this->belongsToMany(Exam::class);
    }

    public function scopeCorrects($query)
    {
        return $query->whereCorrect(1);
    }

    public function scopeIncorrects($query)
    {
        return $query->where('correct', '<>', 1);
    }
}
