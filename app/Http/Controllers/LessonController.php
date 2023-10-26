<?php

namespace App\Http\Controllers;

use App\Http\Requests\LessonRequest;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Course $course)
    {
        //
        $lessons =  $course->lessons()->get();
        // dd($lessons);
        return view('lessons.index', compact('course', 'lessons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Course $course)
    {
        //
        return view('lessons.create', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LessonRequest $request, Course $course)
    {

        // DB::beginTransaction();
        // try {
            //code...
            $lesson = new Lesson;
            $lesson->fill($request->all());
            $lesson->save();
            // DB::commit();
            return redirect()->route('courses.lessons.index',['course'=>$course->id])->with('success', 'Lessons created Successfuly');
        // } catch (\Exception $e) {
        //     //throw $th;
        //     DB::rollBack();
        //     return back()->with('error', 'an error occurred while creating the course');
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course , Lesson $lesson)
    {
        //
        return view('lessons.edit',compact('course','lesson'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LessonRequest $request,Course $course ,$id)
    {
        //
        DB::beginTransaction();
        try {
            //find the course by its ID...
            $lesson = Lesson::findOrFail($id);
            if (!$lesson) {
                DB::rollBack();
                return redirect('/courses')->with('error', 'Lesson not found');
            }
            $lesson->update($request->all());
            DB::commit();

            //redirect to a success page or return a response
            return redirect()->route('courses.lessons.index',['course'=>$course->id])->with('success', 'Lesson updated successfully');
        } catch (\Exception $e) {
            //an error
            DB::rollBack();
            return back()->with('error', 'an error occurred while updating the ');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
