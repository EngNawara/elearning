<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{


    public function index()

    {

        // $course = Course::all();
        // dd($course);
        return view('frontend.courses.index', ['courses' => Course::all()]);
    }


}
