<?php

use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontEnd\CourseController as FrontEndCourseController;
use App\Http\Controllers\FrontEnd\LessonsController as FrontEndLessonsController;
use App\Http\Controllers\LessonController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('home');
});
// Route::get('/', function () {
//     return view('dashBorad');
// });
Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();



Route::group(['middleware' => 'auth', 'prefix' => 'dashbord'], function () {
    Route::get('/', function () {
        return view('dashBorad');
    });
    Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
    Route::resource('roles', 'App\Http\Controllers\RoleController',);
    Route::resource('courses', 'App\Http\Controllers\CourseController',);
    Route::resource('category', 'App\Http\Controllers\CategoryController');
    Route::resource('courses.lessons', LessonController::class);
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
    Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
});


// show without middle ware
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
Route::get('Courses', [FrontEndCourseController::class, 'index'])->name('Courses.index');
Route::get('Courses/{course}/lessons', [FrontEndLessonsController::class,'index'])->name('Courses.lessons.index');
