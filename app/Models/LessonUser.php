<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonUser extends Model
{
    // use HasFactory;
    protected $table = 'lesson_user';
    protected $fillable = ['course_user_id', 'lesson_id', 'date'];
    public function courseUser()
    {
        return $this->belongsTo(CourseUser::class , 'course_user_id');
    }

    public function lesson(){
        return $this->belongsTo(Lesson::class , 'lesson_id');
    }
}
