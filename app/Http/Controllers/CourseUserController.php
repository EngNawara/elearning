<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseUser;
use App\Models\User;
use Illuminate\Http\Request;

class CourseUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($course_id)
    {
        //
        $enrollmentStatuses = ['Accepted','rejected'];

        $courseUsers  = CourseUser::where('course_id', $course_id)->get();
        $course = Course::find($course_id);
        if (!$courseUsers) {
            return view('error', ['message' => 'Course not found']);
        }
        $users = $courseUsers->pluck('user');
        return view('course_user.index', compact('course','users','courseUsers' ,'enrollmentStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseUser $courseUser)
{
    return view('course_user.edit', compact('courseUser'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $courseId, $courseUserId)
    {
            $request->validate(['enrollment_status'=>'required']);
         if(auth()->user()->role_id === 2) {
            $courseUser = CourseUser::findOrFail($courseUserId);
            $course = Course::find($courseUser->course_id);

            // dd($course);
        if ($course && $course->teacher_id === auth()->user()->id ){
                // dd($courseUser);
                $courseUser->update(['enrollment_status' => $request->input('enrollment_status')]);
            return redirect()->back()->with('success' , ' The enrollment status updatedm successfuly');
            }else{
                return  redirect()->back()->with('error' , "you don't have any permation to do this");
            }


        }
            else {
                // Redirect back with an error message for users with roles other than 2
            return redirect()->back()->with('error', 'You do not have permission to do this');
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseUser $course_user)
    {
        // Check if the authenticated user has the required role (assuming role_id 2 means teacher)
        if (auth()->user()->role_id === 2) {
            $course = Course::find($course_user->course_id);

            // Check if the authenticated user is the teacher of the course
            if ($course && $course->teacher_id === auth()->user()->id) {
                // Delete the course user
                $course_user->delete();
                return redirect()->route('userscourse.index',['course_id'=>$course->id])->with('success', 'Course user deleted successfully');
            }
        }
        // dd($course->id);
        return redirect()->route('userscourse.index',)->with('error', 'You are not authorized to delete this course user.');
    }


    public function enrollUser(Request $request)
    {
        $user_id = $request->input('user_id');
        $course_id = $request->route('course_id');
        // dd('test');
        // Retrieve the user and course models
        $user = User::find($user_id);
        $course = Course::find($course_id);

        if ($user && $course) {

            // Check if the user is not already enrolled in the course
            if (!$user->courses->contains($course)) {
                // Enroll the user in the course with additional pivot information
                $user->courses()->syncWithoutDetaching([
                    $course->id => [
                        'enrollment_status' => 'pending',
                        'enrollment_date' => now(),
                    ]
                ]);

                return redirect()->route('Courses.index')->with('message', 'User enrolled in the course successfully');
            } else {
                return redirect()->route('Courses.index')->with('message', 'User is already enrolled in the course.');
            }
        } else {
            return redirect()->route('Courses.index')->with('message', 'User or Course not found');
        }
    }


    public function unenrollUser(Request $request)
    {

        $user_id = $request->input('user_id');
        $course_id = $request->route('course_id');

        // Retrieve the user and course models
        $user = User::find($user_id);
        $course = Course::find($course_id);


        if (!$user || !$course) {
            dd('error');
            return redirect()->route('Courses.index')->with('error', 'User or Course not found');

        }
        if ($user->courses->contains($course)) {
        $user->courses()->detach($course);
        return redirect()->route('Courses.index')->with('message', 'User Unenroll in the course successfully');
    }
    }
}
