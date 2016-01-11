<?php

namespace Education\Entities;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Hash;
use Storage;
use File;
use Carbon\Carbon;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    public $timestamp = true;

    /**
     * The system types array.
     *
     * @var array
     */
    private static $singularTypes = ['superadmin' => 'super administrador', 'admin' => 'administrador', 'registered' => 'registrado'];
    private static $pluralTypes = ['superadmin' => 'super administradores', 'admin' => 'administradores', 'registered' => 'registrados'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'username', 'tel', 'email', 'type', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /* Querys */

    public static function allPaginate($number_pages = 10)
    {
        return self::with('type')->orderBy('updated_at')->paginate($number_pages);
    }

    /* Mutators */
    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['password'] = Hash::make(trim($value));
        }
    }

    public function scopeSuperadmins($query)
    {
        return $query->whereType('superadmin');
    }

    public function scopeAdmins($query)
    {
        return $query->whereType('admin');
    }

    public function scopeRegistereds($query)
    {
        return $query->whereType('registered');
    }

    public function canDestroy()
    {
        if($this->protocolsCreated()->count() + $this->formatsCreated()->count() + 
            $this->categoriesCreated()->count() + $this->exams()->count() == 0){
            return true;
        }

        return false;
    }

    public function isSuperadmin()
    {
        return $this->isType('superadmin');
    }

    public function isAdmin()
    {
        return $this->isType('admin');
    }

    public function isRegistered()
    {
        return $this->isType('registered');
    }

    public function isType($type)
    {
        if ($this->type == $type) {
            return true;
        }

        return false;
    }

    public function getTypeNameAttribute()
    {
        return self::$singularTypes[$this->type];
    }

    public function getTypePluralNameAttribute()
    {
        return self::$pluralTypes[$this->type];
    }

    public function getImageAttribute()
    {
        if (Storage::disk('local')->exists('users/'.$this->id.'/profile.jpg')) {
            return '/storage/users/'.$this->id.'/profile.jpg';
        }

        return env('URL_USER_PHOTO_DEMO').'?'.time();
    }

    public function getUpdatedAtHummansAttribute()
    {
        Carbon::setLocale('es');

        return ucfirst($this->updated_at->diffForHumans());
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function areas()
    {
        return $this->belongsToMany(Area::class);
    }

    public function formats()
    {
        return $this->morphedByMany(Format::class, 'allowed_users');
    }

    public function observationFormats()
    {
        return $this->morphedByMany(ObservationFormat::class, 'allowed_users');
    }

    public function protocols()
    {
        return $this->morphedByMany(Protocol::class, 'allowed_users');
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function protocolsCreated()
    {
        return $this->hasMany(Protocol::class);
    }

    public function formatsCreated()
    {
        return $this->hasMany(Format::class);
    }

    public function generatedProtocols()
    {
        return $this->hasMany(GeneratedProtocol::class);
    }

    public function rolesCreated()
    {
        return $this->hasMany(Role::class);
    }

    public function areasCreated()
    {
        return $this->hasMany(Area::class);
    }

    public function categoriesCreated()
    {
        return $this->hasMany(Category::class);
    }

    public function getExamProtocolsPending()
    {
        return $this->protocols->filter(function ($protocol) {
            return $protocol->isExamPending($this);
        });
    }

    public function getExamProtocolsOk()
    {
        return $this->protocols->filter(function ($protocol) {
            return !$protocol->isExamPending($this);
        });
    }

    public function getAreaIdListsAttribute()
    {
        return $this->areas->lists('id')->all();
    }

    public function getRoleIdListsAttribute()
    {
        return $this->roles->lists('id')->all();
    }

    public function getRoleIdOptions()
    {
        return $this->company->roles->lists('name', 'id')->all();
    }

    public function getAreaIdOptions()
    {
        return $this->company->areas->lists('name', 'id')->all();
    }

    public function syncRelations($data)
    {
        if (array_key_exists('areas', $data)) {
            $this->areas()->sync($data['areas']);
        }

        if (array_key_exists('roles', $data)) {
            $this->roles()->sync($data['roles']);
        }
    }

    public function uploadImage($file)
    {
        if ($file) {
            $path = 'users/'.$this->id.'/profile.jpg';
            Storage::disk('local')->put($path,  File::get($file));

            return true;
        }

        return false;
    }

    public function detachAndDelete()
    {
        $this->areas()->detach();
        $this->roles()->detach();
        $this->delete(); 
    }
}
