<?php namespace Education\Entities; 

use Illuminate\Database\Eloquent\Model;

class QuestionType extends Model
{
	protected $fillable = array('name', 'description');
	public $timestamps = false;
	public $increments = true;
}

