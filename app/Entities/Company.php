<?php

namespace Education\Entities;

use Illuminate\Database\Eloquent\Model;
use Storage;
use File;

class Company extends Model
{
    protected $fillable = ['name', 'tel', 'address', 'email'];
    public $timestamps = true;
    public $increments = true;

    /**
     * @param string $type
     * @param int $paginate
     * @return mixed
     */
    public static function allTypePaginate($type = 'customer', $paginate = 10)
    {
        return self::with(['users', 'protocols'])
            ->whereType('customer')
            ->orderBy('active', 'desc')
            ->paginate($paginate);
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

    public function getAdminUsersCountAttribute()
    {
        return $this->userAdmins()->count();
    }

    public function getRegisteredUsersCountAttribute()
    {
        return $this->userRegistereds()->count();
    }

    public function userAdmins()
    {
        return $this->users()->admins()->get();
    }

    public function userRegistereds()
    {
        return $this->users()->registereds()->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function generators()
    {
        return $this->hasMany(Generator::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
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

    public function formats()
    {
        return $this->hasManyThrough(Format::class, User::class);
    }

    public function observationFormats()
    {
        return $this->hasManyThrough(ObservationFormat::class, User::class);
    }

    public function exams()
    {
        return $this->hasManyThrough(Exam::class, User::class);
    }

    public function maths()
    {
        return $this->hasManyThrough(Math::class, User::class);
    }

    /***** End Relations *****/


    public function surveysNotExam()
    {
        $checks = $this->surveys->filter(function ($survey) {
            return $survey->type->isNotExam();
        });

        return $checks;
    }

    public function surveysNotExamAndAviable()
    {
        $checks = $this->surveys->filter(function ($survey) {
            return $survey->type->isNotExam() && $survey->isAviable();
        });

        return $checks;
    }

    public function getImageAttribute()
    {
    }

    public function getLogoAttribute()
    {
        if (Storage::disk('local')->exists('companies/'.$this->id.'/logo.jpg')) {
            return '/storage/companies/'.$this->id.'/logo.jpg';
        }

        return env('URL_COMPANY_LOGO_DEMO').'?'.time();
    }

    public function uploadLogo($file)
    {
        if ($file) {
            $path = 'companies/'.$this->id.'/logo.jpg';
            Storage::disk('local')->put($path,  File::get($file));
            $this->url_logo = '/storage/'.$path;

            return true;
        }

        return false;
    }

    public function createDefaultData()
    {
        Area::create(array('name' => 'Todas las áreas', 'company_id' => $this->id));
        ProtocolCategory::create(array('name' => 'Todas los Protocolos', 'company_id' => $this->id));
        UserRole::create(array('name' => 'Perfil general', 'company_id' => $this->id));

        return true;
    }

    public function fillAndClear($data)
    {
        $this->fill($data);

        if (array_key_exists('active', $data)) {
            $this->active = 1;
        } else {
            $this->active = 0;
        }
    }
}
