<?php namespace Education\Entities;

use Illuminate\Database\Eloquent\Model;

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

    /**
    * Relations
    */
    public function questions()
    {
        return $this->morphMany(Question::class, 'document');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function areas()
    {
        return $this->belongsToMany(Area::class);
    }
	
	public function exams()
    {
        return $this->hasMany(Exam::class);
    }
	
	/**
    * Querys
    */
	public function getUserExams($user)
    {        
        return $this->exams->where('user_id', $user->id);
    }
	
	public function getUserExamsCount($user)
    {
        return $this->getUserExams($user)->count();
    }
	
	/**
    * Funcions
    */
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
