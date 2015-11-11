<?php namespace Education\Entities; 

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
	protected $fillable = array('name', 'description', 'company_id');
	public $timestamps = true;
	public $increments = true;



    public function Protocols()
    {
        return $this->belongsToMany(Protocol::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}

