<?php namespace Education\Entities;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Hash;

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
     * The system types array
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
    protected $fillable = ['name', 'username', 'type', 'email', 'password'];

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
        if( !empty($value) )
        {
            $this->attributes['password'] = Hash::make(trim($value));
        }
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
        if($this->type == $type)
        {
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

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function protocolsCreated()
    {
        return $this->hasMany(Protocol::class);
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


}
