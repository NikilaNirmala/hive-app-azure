<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->rating) {
            $validated = $request->validate([
                'rating' => 'in:1,2,3,4,5',
            ]);
            $rating = (int)$validated['rating'];
            $reviews = Review::where('rating', $rating)->get();
            return response()->json(['message' => "". $reviews->count(). " reviews found", 'data' => $reviews]);
        }
        $reviews = Review::get();
        return response()->json(['message' => "". $reviews->count(). " reviews found", 'data' => $reviews]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'title'   => 'required|string|max:255',
            'rating'  => 'required|numeric|min:0|max:5',
            'comment' => 'required|nullable|string',
        ]);
        $validated['user_id'] = $request->user()?->id;
        // Create the review
        Review::create($validated);

        // Return JSON response
        return response()->json([
            'message' => 'Review created successfully',
            'data'    => $validated
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $review)
    {

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);
        $fetch = Review::find($review);
        $fetch->rating = $validated['rating'];
        $fetch->save();
        return response()->json([
            'message' => 'review rating updated successfully!',
            'data' => $fetch
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        $review->delete();
         return response()->json([
            'message' => 'Review deleted successfully',
        ], 201);
    }
}
