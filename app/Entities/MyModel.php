<?php

namespace Education\Entities;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class MyModel extends Model
{
    protected function getCreatedAtHummansAttribute()
    {
        Carbon::setLocale('es');
        return ucfirst($this->created_at->diffForHumans());
    }

    protected function getUpdatedAtHummansAttribute()
    {
        Carbon::setLocale('es');
        return ucfirst($this->updated_at->diffForHumans());
    }

    protected function isUser($user)
    {
        if ($this->user_id == $user) {
            return true;
        }

        return false;
    }

}
