<?php namespace Education\Entities; 

use Illuminate\Database\Eloquent\Model;
	
class Role extends Model
{
	protected $fillable = ['name', 'description'];
	public $timestamps = true;
	public $increments = true;



    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function protocols()
    {
        return $this->belongsToMany(Protocol::class);
    }

    public function companies()
    {
        return $this->belongsTo(Company::class);
    }
}

