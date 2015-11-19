<?php namespace Education\Entities; 

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use File, Storage;

class Question extends Model
{
	protected $fillable = ['text'];
	public $timestamps = true;
	public $increments = true;

    /**
     * Get all of the owning document models.
     */
    public function document()
    {
        return $this->morphTo();
    }

    /* Relations */

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    /* End Relations */
}
