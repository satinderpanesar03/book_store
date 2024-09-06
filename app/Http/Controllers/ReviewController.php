<?php

namespace App\Http\Controllers;

use App\Jobs\SendReviewNotification;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ReviewController extends Controller
{
    public function store(Request $request){
        try {
            $validatedData = $request->validate([
                'book_id' => 'required|exists:books,id',
                'rating' => 'required|integer|between:1,5',
                'review' => 'required|string|max:1000',
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        try {
            $review = Review::create([
                'user_id' => Auth::id(),
                'book_id' => $validatedData['book_id'],
                'rating' => $validatedData['rating'],
                'review' => $validatedData['review'],
            ]);

            SendReviewNotification::dispatch($review);

            return redirect()->back()->with('success', 'Review submitted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'There was an error submitting your review. Please try again later.');
        }
    }
}
