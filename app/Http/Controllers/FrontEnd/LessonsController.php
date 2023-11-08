<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonsController extends Controller
{
    //

    public function index(Course $course)
    {


        $lessons = $course->lessons()->get();
        return view('frontend.lessons.index', compact('lessons', 'course'));
    }

    public function show(Course $course , Lesson $lesson) {
        return view('frontend.lessons.show', compact('course' ,'lesson'));
    }
}
