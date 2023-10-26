<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $courses = Course::all();
        // dd($courses);
        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('courses.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseRequest $request)
    {
        //

       DB::beginTransaction();
        try {
            //create new course
            $course = new Course;
            $course->fill($request->all());
            $course->save();
            DB::commit();

            // redirect to success pagee
            return  redirect()->route('courses.index')->with('success', 'Course Created Successfully');
        } catch (\Exception $e) {
            // rolle back the transaction after error occurred
            DB::rollBack();

            // handle the error
            return back()->with('error', 'An error occurred while creating the course');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
        dd($course);
        // return view('Lesson.index',compact('course'))
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $course = Course::find($id);
        $categories = Category::all();
        // dd($categories);
        return view('courses.edit', compact('course', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseRequest $request,  $id)
    {
        //start dataBase transaction
        DB::beginTransaction();
        try {
            //find the course by its ID...
            $course = Course::findOrFail($id);
            if (!$course) {
                DB::rollBack();
                return redirect('/courses')->with('error', 'Course not found');
            }
            $course->fill($request->all());
            $course->save();
            DB::commit();

            //redirect to a success page or return a response
            return redirect('/courses')->with('success', 'Course updated successfully');
        } catch (\Exception $e) {
            //an error
            DB::rollBack();
            return back()->with('error', 'an error occurred while updating the course');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
        $course->delete();
        return redirect()->route('courses.index')->with('success', "Course deleted Successfully");
    }
}
