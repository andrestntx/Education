<?php namespace Education\Entities; 

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
	protected $table = 'answers';
	protected $fillable = ['text', 'correct'];
	public $timestamps = true;
	public $increments = true;
	public $errors;


    public function question()
    {
        return $this->belongsTo('Question', 'question_id');
    }

    public function exams()
    {
        return $this->belongsToMany(Exam::class);
    }

    public function scopeCorrects($query)
    {
        return $query->whereCorrect(true);
    }

    public function scopeIncorrects($query)
    {
        return $query->where('correct', '<>', true);
    }

        
}
