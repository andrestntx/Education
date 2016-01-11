<?php

namespace Education\Entities;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Checklist extends MyModel
{
    protected $fillable = ['observation', 'applied', 'user_id', 'format_id'];
    public $timestamps = true;
    public $increments = true;

    /**
     * Relations.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function format()
    {
        return $this->belongsTo(Format::class);
    }

    public function answers()
    {
        return $this->belongsToMany(Answer::class);
    }

    
}
