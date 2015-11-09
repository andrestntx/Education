<?php namespace Education\Entities; 

use Illuminate\Database\Eloquent\Model;

class CompanyType extends Model
{
	protected $fillable = ['name', 'description'];
	public $timestamps = false;
	public $increments = true;
	public $errors;
}

