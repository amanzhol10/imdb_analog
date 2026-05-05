<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{

    public function index()
    {
        $reviews = \App\Models\Review::with(['user', 'movie', 'tvSeries'])
            ->latest()
            ->paginate(20);
        return view('reviews.index', compact('reviews'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'content'  => 'required|string|max:1000',
            'rating'   => 'required|integer|min:1|max:10',
        ]);

        $alreadyReviewed = Review::where('user_id', Auth::id())
            ->where('movie_id', $validated['movie_id'])
            ->exists();

        if ($alreadyReviewed) {
            return redirect()->back()->withErrors(['review' => 'Вы уже оставили отзыв на этот фильм.']);
        }

        Review::create([
            'user_id'  => Auth::id(),
            'movie_id' => $validated['movie_id'],
            'content'  => $validated['content'],
            'rating'   => $validated['rating'],
        ]);

        return redirect()->back()->with('success', 'Отзыв успешно добавлен.');
    }

    public function edit(Review $review)
    {
        abort_unless(Auth::id() === $review->user_id, 403);
        return view('reviews.edit', compact('review'));
    }

    public function update(Request $request, Review $review)
    {
        abort_unless(Auth::id() === $review->user_id, 403);

        $validated = $request->validate([
            'content' => 'required|string|max:1000',
            'rating'  => 'required|integer|min:1|max:10',
        ]);

        $review->update($validated);

        return redirect()->route('movies.show', $review->movie_id)->with('success', 'Отзыв обновлён.');
    }

    public function destroy(Review $review)
    {
        abort_unless(Auth::id() === $review->user_id || Auth::user()->hasRole(['admin', 'super-admin']), 403);

        $movieId = $review->movie_id;
        $review->delete();

        return redirect()->route('movies.show', $movieId)->with('success', 'Отзыв удалён.');
    }
}
