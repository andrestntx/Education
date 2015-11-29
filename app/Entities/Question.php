<?php

namespace Education\Entities;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['text', 'aviable'];
    public $timestamps = true;
    public $increments = true;

    public function fillAndClear($data)
    {
        $this->fill($data);

        if (array_key_exists('aviable', $data)) {
            $this->aviable = 1;
        } else {
            $this->aviable = 0;
        }
    }

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
