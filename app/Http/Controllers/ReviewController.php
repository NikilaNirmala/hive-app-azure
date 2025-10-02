<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function submit(Request $request) {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        Review::create([
            'title' => $validated['title'],
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
            'user_id' => $request->user()?->id,
        ]);
        return redirect()->route('review')->with('success', 'Review added successfully!');
    }

    public function update(Request $request, Review $review) {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);
        $review->rating = $validated;
        $review->save();

    }
}
