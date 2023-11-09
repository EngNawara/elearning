<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\CourseUser; // Import CourseUser model LessonUserController
use App\Models\LessonUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import Auth facade to access the authenticated user

class LessonsController extends Controller
{
    public function index(Course $course)
    {
        // Get the authenticated user's ID
        $userId = Auth::id();

        // Calculate $completedLessonsCount
        $completedLessonsCount = LessonUser::whereHas('courseUser', function ($query) use ($userId, $course) {
        $query->where('user_id', $userId)->where('course_id', $course->id);})->count();
// dd($completedLessonsCount);
        // Calculate $totalLessonsCount
        $totalLessonsCount = $course->lessons->where('status', 'enabled')->count();
        $lessons = $course->lessons->where('status', 'enabled');
        return view('frontend.lessons.index', compact('lessons', 'course', 'completedLessonsCount', 'totalLessonsCount'));
    }

    public function show(Course $course, Lesson $lesson)
    {
        return view('frontend.lessons.show', compact('course', 'lesson'));
    }
}
