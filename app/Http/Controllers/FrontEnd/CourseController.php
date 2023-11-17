<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Controllers\RatingController;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{


    public function index()

    {

        $courses = Course::where('status', '!=', 'disable')->get();
        $ratingController  = new RatingController();

        foreach ($courses as $course) {
            $ratingInfo = $ratingController->calculateAverageRating($course->id);
            $course->averageRating = $ratingInfo['averageRating'];
        $course->fullStars = $ratingInfo['fullStars'];
        }
        // dd($courses->);
        return view('frontend.courses.index', ['courses' => $courses]);
    }


}
