<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseUser;
use App\Models\User;
class CourseUserController extends Controller
{
    //

    public function index()
    {
        //
        $enrollmentStatuses = ['Enrolled', 'Pending', 'Completed', 'Dropped'];

        $courseUsers  = CourseUser::where('user_id', auth()->user()->id)->get();
        $courses=[];
        foreach($courseUsers as $courseUser) {
            $course = Course::find($courseUser-> course_id);
            if($course) {
                $courses[]=$course;
            }
        }

        return view('frontend.courseUser.index', compact('courses', 'courseUsers', 'enrollmentStatuses'));

    }
}
