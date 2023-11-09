<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Controllers\RatingController;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Course;
class CategoryController extends Controller
{
    //

    public  function index(){
        $categories = Category::all();

        return view('frontend.category.index', compact('categories'));
    }

    public function show(Category $category){
    // category_id
    $courses = Course::where('category_id' , $category->id)->get();
    $ratingController  = new RatingController();

    foreach ($courses as $course) {
        $ratingInfo = $ratingController->calculateAverageRating($course->id);
        $course->averageRating = $ratingInfo['averageRating'];
    $course->fullStars = $ratingInfo['fullStars'];
    }
    // dd($courses);
    return view('frontend.category.show' ,compact('courses' ,'category'));
    }
}
