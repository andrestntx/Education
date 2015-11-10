<?php namespace Education\Entities; 

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
	protected $fillable = array('created_by', 'name', 'description', 'type_id');
	public $timestamps = true;
	public $increments = true;
	public $errors;

    public function scopeWhereNotExam($query)
    {
        return $query->where('type_id', '<>', 1);
    }

    public function getNumberQuestionsAttribute()
    {
        return $this->questions->count();
    }

    public function isAviable()
    {
        if($this->aviable)
        {
            return true;
        }

        return false;

    }

    public function getStateAttribute()
    {
        if($this->aviable)
        {
            return 'Disponible';
        }

        return 'No Disponible';
    }

    public function getShortNameAttribute()
    {
        $new_name = substr($this->name, 0, 22);
        if(strlen($this->name) > 22)
        {
            $new_name .= ' ..';
        }

        return $new_name;
    }

    public function getAreasListsAttribute()
    {
        return $this->areas->lists('id');
    }

    public function getRolesListsAttribute()
    {
        return $this->roles->lists('id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function protocol()
    {
        return $this->belongsTo(Protocol::class);
    }


    public function randomQuestions()
    {
        if($this->questions->count() >= 10)
        {
            return $this->questions->random(10);
        }

        return $this->questions;
    }

    public function scopeUserCanAcces($query, $user_id)
    {
        return $query->joinCanAccess()
            ->where('users_has_access_surveys.user_id', $user_id);
    }

    public function scopeJoinCanAccess($query)
    {
        return $query->join('users_has_access_surveys', 'users_has_access_surveys.survey_id', '=', 'survey.id');
    }

    public function isValid($data)
    {
        $rules = array(
            'name'  => 'required|max:100',
            'created_by' => 'required',
            'type_id' => 'required'
        );

        $validator = Validator::make($data, $rules);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
        
        return false;
    }

    public function validAndSave($data)
    {
        if ($this->isValid($data))
        {
            $this->fill($data);

            if(array_key_exists('survey_aviable', $data))
            {
                $this->aviable = true;  
            }
            else
            {
                $this->aviable = false;    
            }

            $this->save();

            if(array_key_exists('areas', $data))
            {
                $this->syncAreas($data['areas']);
            }

            if(array_key_exists('roles', $data))
            {
                $this->syncRoles($data['roles']);
            }
            
            return true;
        }
        
        return false;
    }

    public function syncRoles($roles = array())
    {
        $this->roles()->sync($roles);
    }

    public function syncAreas($areas = array())
    {
        $this->areas()->sync($areas);
    }
}


?>