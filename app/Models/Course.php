<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','title','price','content','avatar','source'];
    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }
    public function getCategoryListAttribute()
    {
        return $this->categories()->pluck('id');
    }
    public function videos()
    {
        return $this->hasMany(Video::class,'course_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
