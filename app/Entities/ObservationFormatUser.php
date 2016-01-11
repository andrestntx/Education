<?php

namespace Education\Entities;

class ObservationFormatUser extends MyModel
{
    protected $fillable = ['observation', 'applied', 'user_id', 'observation_format_id'];
    protected $table = 'observation_format_user';
    public $timestamps = true;
    public $increments = true;

    /**
     * Relations.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function observationFormat()
    {
        return $this->belongsTo(ObservationFormat::class);
    }

    public function answers()
    {
        return $this->belongsToMany(Answer::class, 'answer_observation', 'observation_id');
    }

    
}
