<?php

use App\User;
namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['from','to','text'];
    protected $quarded = [];
}
