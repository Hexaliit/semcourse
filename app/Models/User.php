<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    protected $fillable = ['name', 'email', 'password'];

    public function corses()
    {
        return $this->hasMany(Course::class,'user_id');
    }
    public function courses()
    {
        return $this->belongsToMany(Course::class)->withTimestamps();
    }
}


