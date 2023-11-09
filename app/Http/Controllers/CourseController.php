<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = auth()->user();
        if ($user->role_id === 1) {
            $courses = Course::all();
        } elseif ($user->role_id === 2) {
            $user_id = $user->id;
            $courses = Course::where('teacher_id', $user_id)->get();
        }
        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();
        return view('courses.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(CourseRequest $request)
    {
        DB::beginTransaction();
        $user = auth()->user();
        try {
            // Create a new course
            $course = new Course;
            $course->fill($request->all());

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('storage/Course'), $imageName);
                $course->image = 'storage/Course/' . $imageName;
            }

            $course->teacher_id = $user->id;
            $course->save();
            DB::commit();

            // Redirect to the success page
            return redirect()->route('courses.index')->with('success', 'Course Created Successfully');
        } catch (\Exception $e) {
            // Rollback the transaction after an error occurs
            DB::rollBack();

            // Handle the error
            return back()->with('error', 'An error occurred while creating the course: ' . $e->getMessage());
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
        $user = auth()->user();
        $categories = Category::all();
        if ($user->role_id === 1) {
            $course = Course::find($id);
        } elseif ($user->role_id === 2) {
            $user_id = $user->id;
            $courses = Course::where('teacher_id', $user_id)->get();
            $course = $courses->find($id);
        }
        return view('courses.edit', compact('course', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseRequest $request,  $id)
    {
        //start dataBase transaction
        // dd($request->all());
        DB::beginTransaction();
        try {
            //find the course by its ID...
            $course = Course::findOrFail($id);
            if (!$course) {
                DB::rollBack();
                return redirect('/courses')->with('error', 'Course not found');
            }
            $course->fill($request->all());
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('storage/Course'), $imageName);
                $course->image = 'storage/Course/' . $imageName;
            }
            if ($request->has('is_popular')) {
                $course->is_popular = $request->input('is_popular');
            }
            $course->save();
            DB::commit();

            //redirect to a success page or return a response
            return redirect()->route('courses.index')->with('success', 'Course updated successfully');
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
        $user = auth()->user();

        if ($user->role_id === 1) {
            $course->delete();
        } elseif ($user->role_id === 2) {
            // Assuming 'teacher_id' is the column in the courses table that stores the teacher's ID
            if ($course->teacher_id === $user->id) {
                $course->delete();
            } else {
                return redirect()->route('courses.index')->with('error', "You don't have permission to delete this course.");
            }
        }

        return redirect()->route('courses.index')->with('success', "Course deleted Successfully");
    }

    public function updateIsPopular(Request $request,  $id)
    {
        //  dd($request->all());
        $request->validate([
            'is_popular' => 'required',
        ]);
        $course = Course::findOrFail($id);
        $course->is_popular = $request->input('is_popular');
        $course->save();
        return redirect()->route('courses.index')->with('success', 'Course updated successfully');
    }

    // public function isActiveSLider(Request $request,  $id)
    // {

    //     $request->validate([
    //         'is_best' => 'required',
    //     ]);
    //     $course = Course::findOrFail($id);
    //     dd($course);
    //     $course->is_best = $request->input('is_best');
    //     $course->save();
    //     return redirect()->route('courses.index')->with('success', 'Course updated successfully');
    // }

    public function isActiveSLider(Request $request, $id)
{
    // Validate the request data
    $validator = Validator::make($request->all(), [
        'is_best' => 'required',
    ]);

    if ($validator->fails()) {
        return redirect()
            ->route('courses.index')
            ->withInput()
            ->withErrors($validator)
            ->with('error', 'Validation failed');
    }

    try {
        $course = Course::findOrFail($id);
        // Update the course
        $course->is_best = $request->input('is_best');
        $course->save();
        return redirect()
            ->route('courses.index')
            ->with('success', 'Course updated successfully');
    } catch (ModelNotFoundException $e) {
        return redirect()
            ->route('courses.index')
            ->with('error', 'Course not found');
    }
}
}
