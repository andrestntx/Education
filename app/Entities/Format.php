<?php namespace Education\Entities;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Format extends Model
{
    protected $fillable = ['name', 'description', 'aviable'];
	public $timestamps = true;
	public $increments = true;
    
    /**
    * Muttators
    */
    public function getUpdatedAtHummansAttribute()
    {
        Carbon::setLocale('es');
        return ucfirst($this->updated_at->diffForHumans());
    }

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
    * Relations
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
	
	public function checklists()
    {
        return $this->hasMany(Checklist::class);
    }
	
	/**
    * Querys
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
    * Funcions
    */
    public function isAviable()
    {
        if( $this->aviable && $this->questions->count() > 0)
        {
            return true;
        }

        return false;
    }

	public function fillAndClear($data)
    {
        $this->fill($data);

        if(array_key_exists('aviable', $data))
        {
            $this->aviable = 1;
        }
        else
        {
            $this->aviable = 0;
        }
    }
	
	public function syncRelations($data)
    {
        if(array_key_exists('areas', $data))
        {
            $this->areas()->sync($data['areas']);
        }          

        if(array_key_exists('roles', $data))
        {
            $this->roles()->sync($data['roles']);
        }
    }

}
