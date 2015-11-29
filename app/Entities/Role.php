<?php

namespace Education\Entities;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Role extends Model
{
    protected $fillable = ['name', 'description'];
    public $timestamps = true;
    public $increments = true;

    public function getUpdatedAtHummansAttribute()
    {
        Carbon::setLocale('es');

        return ucfirst($this->updated_at->diffForHumans());
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
        return $this->morphedByMany(Protocol::class, 'allowed_roles');
    }

    public function companies()
    {
        return $this->belongsTo(Company::class);
    }
}
