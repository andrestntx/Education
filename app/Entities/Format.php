<?php

namespace Education\Entities;


class Format extends MyDocument
{
    protected $fillable = ['name', 'description', 'aviable'];
    public $timestamps = true;
    public $increments = true;

    
    /**
     * Relations.
     */
    public function checklists()
    {
        return $this->hasMany(Checklist::class);
    }

    /**
     * Querys.
     */
    public function getUserChecklists($user)
    {
        return $this->checklists->where('user_id', $user->id);
    }

    public function getUserChecklistsCount($user)
    {
        return $this->getUserChecklists($user)->count();
    }

    /**
     * Funcions.
     */
    public function isAviable()
    {
        if ($this->aviable && $this->hasQuestions()) {
            return true;
        }

        return false;
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
