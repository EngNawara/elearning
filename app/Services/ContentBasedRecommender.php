<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Course;

class ContentBasedRecommender
{

    //features: genres (DONE), countries (IN PROGRESS), keywords, cast, companies (IN PROGRESS), language (DONE)

    public function suggestCourseFor(Course $course)
    {
        $selectedCourse = $course->id;
        $courseScores = [];

        //category scores

        $category = Category::find($course->category_id);
        $this->addCategoryScores($category, $courseScores);

        //TOTAL SCORES
        arsort($courseScores);
        $maxScore = $courseScores[$selectedCourse]; //100% (use to calculate similarity %)
        unset($courseScores[$selectedCourse]);
        $suggestedCourses = array_slice($courseScores, 0, 10, true);
        return $suggestedCourses;
    }

    private function addCategoryScores($category, &$courseScores)
    {

        foreach ($category->courses as $course) {
            if (isset($courseScores[$course->id])) {
                $courseScores[$course->id] += 1;
            } else {
                $courseScores[$course->id] = 1;
            }
        }

    }

}
