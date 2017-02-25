<?php
namespace Education\Entities;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    protected $table = 'protocol_forums';
    protected $fillable = ['comment', 'user_id', 'protocol_id'];
    public $timestamps = true;
    public $increments = true;

    public function protocol()
    {
        return $this->belongsTo(Protocol::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
