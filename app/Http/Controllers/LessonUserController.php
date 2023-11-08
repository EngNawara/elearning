<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LessonUser;

class LessonUserController extends Controller
{
    //
    public function store( Request $request){

        $request->validate([
            'lesson_id' => 'required',
            'course_user_id' => 'required',
        ]);

        LessonUser::create([
            'lesson_id' => $request->input('lesson_id'),
            'course_user_id' => $request->input('course_user_id'),
        ]);

        return redirect()->back()->with('success', 'Lesson marked as completed.');
    }
}
