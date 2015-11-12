<?php namespace Education\Entities; 

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
	protected $fillable = array('text', 'survey_id', 'type_id');
	public $timestamps = true;
	public $increments = true;

    /* Relations */


    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function protocol()
    {
        return $this->belongsTo(Protocol::class);
    }

    /* End Relations */
}
