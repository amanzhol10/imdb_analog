<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->paginate(12);

        return view('movies.index', compact('movies'));
    }

    public function show(Movie $movie)
    {
        $movie->load('reviews.user');
        $avgRating = $movie->reviews->avg('rating');
        $userReview = auth()->check()
            ? $movie->reviews->firstWhere('user_id', auth()->id())
            : null;

        return view('movies.show', compact('movie', 'avgRating', 'userReview'));
    }

    public function create()
    {
        return view('movies.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'year'        => 'required|integer|min:1888|max:' . (date('Y') + 5),
            'director'    => 'required|string|max:255',
            'poster'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('poster')) {
            $validated['poster_path'] = $request->file('poster')->store('posters', 'public');
        }

        Movie::create($validated);

        return redirect()->route('movies.index')->with('success', 'Фильм добавлен.');
    }

    public function edit(Movie $movie)
    {
        return view('movies.edit', compact('movie'));
    }

    public function update(Request $request, Movie $movie)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'year'        => 'required|integer|min:1888|max:' . (date('Y') + 5),
            'director'    => 'required|string|max:255',
            'poster'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('poster')) {
            if ($movie->poster_path) {
                Storage::disk('public')->delete($movie->poster_path);
            }
            $validated['poster_path'] = $request->file('poster')->store('posters', 'public');
        }

        $movie->update($validated);

        return redirect()->route('movies.show', $movie)->with('success', 'Обновлено.');
    }
    public function destroy(Movie $movie)
    {
        $movie->delete();
        return redirect()->route('movies.index')->with('success', 'Фильм удалён.');
    }
}
