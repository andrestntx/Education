<?php namespace Education\Entities; 

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
	protected $fillable = ['name'];
	public $timestamps = true;
	public $increments = true;

    public static function allTypePaginate($type = 'customer', $paginate = 10)
    {
        return self::with(['users', 'protocols'])->whereType('customer')->paginate(10);
    }

    public function getAreasCountAttribute()
    {
        return $this->areas->count();
    }

    public function getRolesCountAttribute()
    {
        return $this->roles->count();
    }

    public function getProtocolsCountAttribute()
    {
        return $this->protocols->count();
    }

    public function getExamsCountAttribute()
    {
        return $this->exams->count();
    }

    public function getCategoriesCountAttribute()
    {
        return $this->categories->count();
    }

    public function getUsersCountAttribute()
    {
        return $this->users->count();
    }

    public function userAdmins()
    {
        return $this->users()->whereType('admin')->get();
    }

	/** 
     * Relation
     * @return Education\Entities\User
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function roles()
    {
        return $this->hasManyThrough(Role::class, User::class);
    }

    public function areas()
    {
        return $this->hasManyThrough(Area::class, User::class);
    }

    public function categories()
    {
        return $this->hasManyThrough(Category::class, User::class);
    }

    public function protocols()
    {
        return $this->hasManyThrough(Protocol::class, User::class);
    }

    /** 
     * Relation
     * @return Education\Entities\Exam
     */
    public function exams()
    {
        return $this->hasManyThrough(Exam::class, User::class);
    }


	/***** End Relations *****/

	public function surveysNotExam()
    {
        $checks = $this->surveys->filter(function($survey)
        {
            return $survey->type->isNotExam();
        });

        return $checks;
    }

    public function surveysNotExamAndAviable()
    {
        $checks = $this->surveys->filter(function($survey)
        {
            return $survey->type->isNotExam() && $survey->isAviable();
        });

        return $checks;
    }

	public function getLogoAttribute()
	{
		/*if (File::exists($this->url_logo))
		{
			return $this->url_logo.'?'.time();
		}
		else
		{
			return Config::get('constant.url_company_logo_demo').'?'.time();
		}*/

        return env('URL_COMPANY_LOGO_DEMO').'?'.time();
	}

	public static function findOrActual($id = null)
	{
		if(is_null($id))
		{
			return Session::get('actual_company');
		}
		else
		{
			return Company::find($id);
		}
	}

	public function isValidLogo($logo)
    {
        if(!is_null($logo) && !$logo->isValid())
        {
            $this->errors = array('El logo debe ser menor que '.ini_get('upload_max_filesize'));
            return false;
        }

        return true;
    }

	public function isValid($data)
    {
        $rules = array(
            'name'     => 'required|max:100|unique:company',
            'url_logo' => 'mimes:jpeg,png,bmp|max:1500'
        );

        if ($this->exists)
        {
			$rules['name'] .= ',name,'.$this->id.',id';
        }
        else 
        {
            $rules['url_logo'] .= '|required';
            $rules['type_id'] .= '|required';
        }
        
        $validator = Validator::make($data, $rules);
        
        if ($validator->passes())
        {
            return true;
        }
        
        $this->errors = $validator->errors();
        
        return false;
    }

    public function validAndSave($data, $logo)
    {
        if ($this->isValidLogo($logo) && $this->isValid($data))
        {
            $this->fill($data);
            $this->save();
            $this->uploadLogo($logo);
            
            return true;
        }
        
        return false;
    }

    public function uploadLogo($file)
    {
    	if(File::isFile($file))
    	{
	    	$url_logo = Config::get('constant.path_companies_logos').'/'.$this->id.'.'.$file->getClientOriginalExtension();
	    	Image::make($file)->widen(225)->save($url_logo);
	    	$this->url_logo = $url_logo;
	    	$this->save();
    	}
    }

    public function createDefaultData()
    {
    	Area::create(array('name' =>  'Todas las áreas', 'company_id' => $this->id));
    	ProtocolCategory::create(array('name' =>  'Todas los Protocolos', 'company_id' => $this->id));
    	UserRole::create(array('name' =>  'Perfil general', 'company_id' => $this->id));

    	return true;
    }
}
