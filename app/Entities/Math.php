<?php

namespace Education\Entities;

use Illuminate\Database\Eloquent\Model;

class Math extends Model
{
    protected $fillable = ['title', 'description', 'url'];
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

    /* Relations */

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /* End Relations */
}
