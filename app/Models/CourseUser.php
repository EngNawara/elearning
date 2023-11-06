<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseUser extends Model
{
    // use HasFactory;
    protected $table = 'course_user';
    protected $fillable = ['user_id', 'course_id', 'enrollment_status'];


    public function course():BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function students(){
        return $this->belongsToMany(User::class , 'course_user')->withPivot(['enrollment_status' ,'enrollment_date']);
    }
}
