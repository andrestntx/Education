<?php

namespace Education\Entities;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Checklist extends Model
{
    protected $fillable = ['observation', 'applied', 'user_id', 'format_id'];
    public $timestamps = true;
    public $increments = true;

    public function getCreatedAtHummansAttribute()
    {
        Carbon::setLocale('es');

        return ucfirst($this->created_at->diffForHumans());
    }

    public function getUpdatedAtHummansAttribute()
    {
        Carbon::setLocale('es');

        return ucfirst($this->updated_at->diffForHumans());
    }

    /**
     * Relations.
     */
    public function answers()
    {
        return $this->belongsToMany(Answer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function format()
    {
        return $this->belongsTo(Protocol::class);
    }

    /**
     * Scopes.
     */
    public function isUser($user)
    {
        if ($this->user_id == $user) {
            return true;
        }

        return false;
    }
}
