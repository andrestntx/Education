<?php namespace Education\Entities; 

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Area extends Model
{
	protected $fillable = array('name', 'description');
	public $timestamps = true;
	public $increments = true;

    public function getUpdatedAtHummansAttribute()
    {
        Carbon::setLocale('es');
        return ucfirst($this->updated_at->diffForHumans());
    }

    public function protocols()
    {
        return $this->morphedByMany(Protocol::class, 'allowed_areas');
    }

    public function formats()
    {
        return $this->morphedByMany(Protocol::class, 'allowed_areas');
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

