<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseUserController;
<<<<<<< HEAD
=======
use App\Http\Controllers\FrontEnd\CourseController as FrontEndCourseController;
use App\Http\Controllers\FrontEnd\CourseUserController as FrontEndCourseUserController;
use App\Http\Controllers\FrontEnd\LessonsController as FrontEndLessonsController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\LessonUserController;
use App\Http\Controllers\RatingController;
>>>>>>> main
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontEnd\CourseController as FrontEndCourseController;
use App\Http\Controllers\FrontEnd\LessonsController as FrontEndLessonsController;
use App\Http\Controllers\FrontEnd\CourseUserController as FrontEndCourseUserController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\LessonUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

<<<<<<< HEAD

=======
>>>>>>> main
Route::get('/', function () {return view('home');});
Route::get('about', function () {return view('about');})->name('about');
Route::get('contact', function () {return view('contact');})->name('contact');

Auth::routes();

Route::group(['middleware' => 'auth', 'prefix' => 'dashborad'], function () {
    Route::get('/', function () {
        return view('dashBorad');
    })->name('dashborad');
    Route::group(['middleware' => 'checkRole:teacher,admin'], function () {
        Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
        Route::resource('roles', 'App\Http\Controllers\RoleController');
        Route::resource('courses', 'App\Http\Controllers\CourseController');
        Route::resource('category', 'App\Http\Controllers\CategoryController');
        Route::resource('courses.lessons', LessonController::class);
        Route::resource('/courses/{course_id}/userscourse', CourseUserController::class);
        // edit profile for user (admin and teacher)
        Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
        Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
        // edit profile for user (student)
        Route::get('front/profile', ['as' => 'frontend.profile.edit', 'uses' => 'App\Http\Controllers\FrontEnd\ProfileFrontController@edit']);
        Route::put('front/profile', ['as' => 'frontend.profile.edit', 'uses' => 'App\Http\Controllers\FrontEnd\ProfileFrontController@update']);

        Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
        Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
        Route::put('courses/{course}/update-is-popular', [CourseController::class, 'updateIsPopular'])->name('courses.updateIsPopular');
        Route::put('courses/{course}/update-is-best-course', [CourseController::class, 'isActiveSLider'])->name('courses.isActiveSLider');
        Route::put('category/{category}/homecategory', [CategoryController::class, 'homecategory'])->name('category.homecategory');
        Route::post('courses/{course_id}/userscourse/enroll', [CourseUserController::class, 'enrollUser'])->name('course.userscourse.enroll');
        Route::post('courses/{course_id}/userscourse/unenrollUser', [CourseUserController::class, 'unenrollUser'])->name('course.userscourse.unenrollUser');
        // ratings
<<<<<<< HEAD
        Route::post('courses/rating' ,[RatingController::class ,'create'])->name('ratings.create');
        // show list from  user course
        Route::get('coursesUser/all',[FrontEndCourseUserController::class ,'index'])->name('frontend.listuserCourse');
    });
});


=======
        Route::post('courses/rating', [RatingController::class, 'create'])->name('ratings.create');
        // show list from  user course
        Route::get('coursesUser/all', [FrontEndCourseUserController::class, 'index'])->name('frontend.listuserCourse');
    });
});

>>>>>>> main
// show without middle ware
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::get('front/login', function () {
    return view('frontend.auth.login');
})->name('loginFront');

Route::get('front/register', function () {
    return view('frontend.auth.register');
})->name('registerFront');
Route::get('Courses', [FrontEndCourseController::class, 'index'])->name('Courses.index');
Route::get('Courses/{course}/lessons', [FrontEndLessonsController::class, 'index'])->name('Courses.lessons.index');
Route::get('Courses/{course}/lessons/{lesson}', [FrontEndLessonsController::class, 'show'])->name('Courses.lessons.show');
<<<<<<< HEAD
Route::post('/lesson-users', [LessonUserController::class ,'store'])->name('lessonUser.store');

=======
Route::post('/lesson-users', [LessonUserController::class, 'store'])->name('lessonUser.store');
>>>>>>> main
