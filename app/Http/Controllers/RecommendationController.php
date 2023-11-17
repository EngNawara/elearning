<?php

namespace App\Http\Controllers;

use DB;
use Phpml\Association\Apriori;

class RecommendationController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function generateRecommendations($course_id)
    {
        $coursesBoughtTogether = DB::table('course_user')
            ->select('course_id', 'user_id')
            ->get();
        $groupedCourses = $coursesBoughtTogether->groupby('user_id')
            ->toArray();
        //return $groupedCourses;

        // $string = print_r($groupedCourses);
        // $courses[] = json_decode($string, true);
        $attrs = [];
        $i = 0;
        foreach ($groupedCourses as $g) {
            // -> as it return std object
            foreach ($g as $x) {

                $coursesArray[$i][] = $x->course_id;
            }
            $i = $i + 1;
        }

        $lables = [];

        $apriori = new Apriori(0.5, 0.5);

        $apriori->train($coursesArray, $lables);

        $predictions = $apriori->predict([$course_id]);
        foreach ($predictions as $p) {
            // -> as it return std object
            foreach ($p as $pp) {

                $predictionsArray[] = $pp;
            }

        }
        return $predictionsArray;
    }

    public function similarityByRatings()
    {
    }

}
