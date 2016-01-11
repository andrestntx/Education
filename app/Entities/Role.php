<?php

namespace Education\Entities;


class Role extends MyModel
{
    protected $fillable = ['name', 'description'];
    public $timestamps = true;
    public $increments = true;

    /**
    * Relations
    */
    public function companies()
    {
        return $this->belongsTo(Company::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function protocols()
    {
        return $this->morphedByMany(Protocol::class, 'allowed_roles');
    }

    public function formats()
    {
        return $this->morphedByMany(Format::class, 'allowed_roles');
    }

    public function observationFormats()
    {
        return $this->morphedByMany(ObservationFormat::class, 'allowed_roles');
    }
}
