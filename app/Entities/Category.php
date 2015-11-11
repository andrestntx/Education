<?php namespace Education\Entities; 

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
	
class Category extends Model
{
	protected $fillable = ['name', 'description', 'company_id'];
	public $timestamps = true;
	public $increments = true;

    public function getUpdatedAtHummansAttribute()
    {
        Carbon::setLocale('es');
        return ucfirst($this->updated_at->diffForHumans());
    }

    public function protocols()
    {
        return $this->belongsToMany(Protocol::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

}
