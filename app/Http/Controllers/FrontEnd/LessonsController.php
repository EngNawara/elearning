<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson; // Import CourseUser model LessonUserController
use App\Models\LessonUser;
use Illuminate\Support\Facades\Auth;

// Import Auth facade to access the authenticated user

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
        /*  $collab_engine = new CollaborativeRecommender;
        //return array key value where key = course id and value = score
        $collab_suggestions = $collab_engine->suggestCourseFor($course);
        $collab_courses = [];

        //create array with Course models
        foreach ($collab_suggestions as $course_id => $score) {
        $collab_suggested_course = Course::find($course_id);

        $collab_courses[] = $collab_suggested_course; //append course to array
        }

        ini_set('memory_limit', '1024M'); //TO-DO: FIND A WAY TO USE LESS MEMORY AND REMOVE THIS
        ini_set('max_execution_time', 120);

        $content_engine = new ContentBasedRecommender;
        $content_suggestions = $content_engine->suggestCourseFor($course);
        $content_courses = [];

        //create array with Course models
        foreach ($content_suggestions as $course_id => $score) {
        $content_suggested_course = Course::find($course_id);

        $content_courses[] = $content_suggested_course; //append course to array
        }
         */
        return view('frontend.lessons.show', compact('course', 'lesson')); //'collab_suggestions', 'collab_courses', 'content_suggestions', 'content_courses'
    }
}
