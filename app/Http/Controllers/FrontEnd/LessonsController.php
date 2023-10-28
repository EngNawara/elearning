<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class LessonsController extends Controller
{
    //

    public function index(Course $course)
    {


        $lessons = $course->lessons()->get();
        return view('frontend.lessons.index', compact('lessons', 'course'));
    }
}
