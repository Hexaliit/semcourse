<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','title','price','content','avatar','source'];
    public function Categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }
    public function videos()
    {
        return $this->hasMany(Video::class,'course_id');
    }
}
