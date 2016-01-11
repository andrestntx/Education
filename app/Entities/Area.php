<?php

namespace Education\Entities;

class Area extends MyModel
{
    protected $fillable = ['name', 'description'];
    public $timestamps = true;
    public $increments = true;

    /**
    * Relations
    */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function protocols()
    {
        return $this->morphedByMany(Protocol::class, 'allowed_areas');
    }

    public function formats()
    {
        return $this->morphedByMany(Format::class, 'allowed_areas');
    }

    public function observationFormats()
    {
        return $this->morphedByMany(ObservationFormat::class, 'allowed_areas');
    }
    
}
