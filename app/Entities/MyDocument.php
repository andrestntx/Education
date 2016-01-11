<?php

namespace Education\Entities;

class MyDocument extends MyModel
{

    /**
     * Accesors.
     */
    public function getNumberQuestionsAttribute()
    {
        return $this->questions->count();
    }

    public function getAreaIdListsAttribute()
    {
        return $this->areas->lists('id')->all();
    }

    public function getRoleIdListsAttribute()
    {
        return $this->roles->lists('id')->all();
    }

    /**
     * Relations.
     */
    public function questions()
    {
        return $this->morphMany(Question::class, 'document');
    }

    public function roles()
    {
        return $this->morphToMany(Role::class, 'allowed_roles');
    }

    public function areas()
    {
        return $this->morphToMany(Area::class, 'allowed_areas');
    }

    /**
     * Functions.
     */
    public function syncRelations(array $data = array())
    {
        $this->syncDefaultRelations($data);
    }

    protected function syncDefaultRelations(array $data = array())
    {
        $this->syncAreas($data);
        $this->syncRoles($data);
    }

    private function syncAreas(array $data = array())
    {
        if (array_key_exists('areas', $data)) {
            $this->areas()->sync($data['areas']);
        }
    } 

    private function syncRoles(array $data = array())
    {
        if (array_key_exists('roles', $data)) {
            $this->roles()->sync($data['roles']);
        }
    } 

    private function syncAvialbe(array $data = array())
    {
        if (array_key_exists('aviable', $data)) {
            $this->aviable = 1;
        } else {
            $this->aviable = 0;
        }
    } 

    public function fillAndClear(array $data = array())
    {
        $this->fill($data);
        $this->syncAvialbe($data);
    }

    public function isAviable()
    {
        if ($this->aviable) {
            return true;
        }

        return false;
    }

    public function hasQuestions()
    {
        if($this->questions->count() > 0){
            return true;
        }

        return false;
    }

    public function getStateAttribute()
    {
        if ($this->isAviable()) {
            return 'Disponible';
        }

        return 'No Disponible';
    }

}
