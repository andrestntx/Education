<?php

namespace Education\Entities;


class Category extends MyModel
{
    protected $fillable = ['name', 'description', 'company_id'];
    public $timestamps = true;
    public $increments = true;

    /**
    * Relations
    */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function protocols()
    {
        return $this->belongsToMany(Protocol::class);
    }

    
}
