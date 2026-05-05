<?php
namespace App\Http\Controllers;

use App\Models\TvSeries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TvSeriesController extends Controller
{
    public function index()
    {
        $series = TvSeries::withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->paginate(12);
        return view('tv_series.index', compact('series'));
    }

    public function show(TvSeries $tvSeries)
    {
        $tvSeries->load('reviews.user', 'actors', 'genres');
        $avgRating = $tvSeries->reviews->avg('rating');
        $userReview = auth()->check()
            ? $tvSeries->reviews->firstWhere('user_id', auth()->id())
            : null;
        return view('tv_series.show', compact('tvSeries', 'avgRating', 'userReview'));
    }

    public function create()
    {
        return view('tv_series.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'year'        => 'required|integer|min:1888|max:' . (date('Y') + 5),
            'director'    => 'nullable|string|max:255',
            'seasons'     => 'required|integer|min:1',
            'status'      => 'required|in:ongoing,ended',
            'poster'      => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);
        if ($request->hasFile('poster')) {
            $validated['poster_path'] = $request->file('poster')->store('posters', 'public');
        }
        TvSeries::create($validated);
        return redirect()->route('tv-series.index')->with('success', 'Сериал добавлен.');
    }

    public function destroy(TvSeries $tvSeries)
    {
        $tvSeries->delete();
        return redirect()->route('tv-series.index')->with('success', 'Сериал удалён.');
    }
}