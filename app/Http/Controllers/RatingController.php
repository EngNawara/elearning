<?php

namespace App\Http\Controllers;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function create(Request $request)
    {
        $courseId = $request->input('course_id');
        $userId = auth()->id();

        // Check if the user has already submitted a review for this course
        $existingRating = Rating::where('course_id', $courseId)
            ->where('user_id', $userId)
            ->first();

        if ($existingRating) {
            // User has already submitted a review, return an error message
            return redirect()->back()->with('error', 'You have already submitted a review for this course.');
        }

        $this->validate($request, [
            'content' => 'nullable|string',
            'rate' => 'required|integer|between:1,5',
            'course_id' => 'required',
        ]);

        $rating = Rating::create([
            'content' => $request->input('content'),
            'rate' => $request->input('rate'),
            'course_id' => $courseId,
            'user_id' => $userId,
        ]);

    return redirect()->back()->with('success', 'Your review has been submitted.');
    }


    // Show all ratings for a course
    public function showAllRatings($courseId)
    {
        $ratings = Rating::where('course_id', $courseId)->get();
        return view('frontend.lessons.index', ['ratings' => $ratings]);
    }

    // Calculate the average rating for a course
    public function calculateAverageRating($courseId)
    {
        $averageRating = Rating::where('course_id', $courseId)->avg('rate');
        $fullStars = floor($averageRating);
        return ['averageRating' => $averageRating, 'fullStars' => $fullStars];
    }

}

