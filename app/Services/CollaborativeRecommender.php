<?php

namespace App\Services;

use App\Models\Course;
use Illuminate\Support\Facades\DB;

class CollaborativeRecommender
{

    public function suggestCourseFor(Course $course)
    {
        $selectedCourse = $course->id;

        $usersWhoLikedIt = $this->getUsersWhoLiked($selectedCourse);
        $suggestedCourses = $this->getSuggestedCourses($usersWhoLikedIt, $selectedCourse);

        //$suggestedMovies = array_pad([], 10, 0);

        return $suggestedCourses;
    }

    private function getUsersWhoLiked($courseID)
    {

        $userObjects = DB::table('ratings')
            ->select('user_id')
            ->where('course_id', $courseID)
            ->where('rating', 5)
            ->get()
            ->toArray();

        $users = [];

        foreach ($userObjects as $userObject) {
            array_push($users, $userObject->user_id);
        }

        return $users; //array of objects
    }

    private function getSuggestedCourses($users, $id)
    {
        $ratingObjects = DB::table('ratings')
            ->whereIn('user_id', $users)
            ->select('course_id', 'user_id', 'rating')
            ->get();

        $courseScores = [];

        foreach ($ratingObjects as $ratingObject) {
            if (isset($courseScores[$ratingObject->course_id])) {
                $courseScores[$ratingObject->course_id] += $ratingObject->rating;
            } else {
                $courseScores[$ratingObject->course_id] = $ratingObject->rating;
            }
        }

        arsort($courseScores);
        unset($courseScores[$id]);
        $courseScores = array_slice($courseScores, 0, 10, true);

        return $courseScores;
    }
}
