<?php namespace LaravelAppUi\Entities;

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
    protected $table = 'user';
    public $timestamp = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'username', 'type_id', 'email', 'password'];

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
        if(!empty($value)){
            $this->attributes['password'] = Hash::make(trim($value));
        }
    }

    public function getTypeNameAttribute()
    {
        return $this->type->name;
    }

    public function getCountVotersAttribute()
    {
        return $this->voters->count();
    }

    public function getCountPollsAttribute()
    {
        return $this->voterPolls->count();
    }

    /* Functions */
    
    public function getMenuModules()
    {
        return $this->type->getMenuModules();
    }

    public function getModuleNames()
    {
        return $this->type->getModuleNames();
    }

    public function hasModule($module)
    {
        return $this->type->hasModule($module);
    }

    public function voterPollsRealized($poll_id)
    {
        return $this->voterPolls()->realized()->wherePollId($poll_id)->count();
    }

    public function voterPollsAnswered($poll_id)
    {
        return $this->voterPolls()->whereResult('answer')->wherePollId($poll_id)->count();
    }

     public function voterPollsRealizedToday($poll_id)
    {
        return $this->voterPolls()->realized()->wherePollId($poll_id)->today()->count();
    }

    public function voterPollsAnsweredToday($poll_id)
    {
        return $this->voterPolls()->whereResult('answer')->wherePollId($poll_id)->today()->count();
    }


    /* Relations */
    public function type()
    {
        return $this->belongsTo('LaravelAppUi\Entities\UserType', 'type_id');
    }

    public function voters()
    {
        return $this->hasMany('LaravelAppUi\Entities\Voter', 'created_by', 'id');
    }

    public function voterPolls()
    {
        return $this->hasMany('LaravelAppUi\Entities\VoterPoll');
    }

}
