<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['user_id','content'];

    public $with = ['user','likes'];


    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    /*public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }*/
}
