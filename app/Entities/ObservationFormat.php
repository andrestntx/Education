<?php

namespace Education\Entities;


class ObservationFormat extends MyDocument
{
    protected $fillable = ['name', 'description', 'aviable'];
    public $timestamps = true;
    public $increments = true;

    public function observations()
    {
        return $this->hasMany(ObservationFormatUser::class);
    }

    public function getUserObservations($user)
    {
        return $this->observations->where('user_id', $user->id);
    }

    public function getUserObservationsCount($user)
    {
        return $this->getUserObservations($user)->count();
    }

    public function isAviable()
    {
        return $this->aviable && $this->hasQuestions();
    }

    public function orderNewQuestion()
    {
        return $this->questions()->count() + 1;
    }

    public function detachAndDelete()
    {
        $this->areas()->detach();
        $this->roles()->detach();
        $this->delete(); 
    }
}
