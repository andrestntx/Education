<?php namespace Education\Entities; 

use Illuminate\Database\Eloquent\Model;

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

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function protocol()
    {
        return $this->belongsTo(Protocol::class);
    }

}


?>