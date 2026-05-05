<?php
namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\TvSeries;

class HomeController extends Controller
{
    public function index()
    {
        $topMovies = Movie::withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->orderByDesc('reviews_avg_rating')
            ->take(8)->get();

        $popularMovies = Movie::withCount('reviews')
            ->orderByDesc('reviews_count')
            ->take(8)->get();

        $topSeries = TvSeries::withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->orderByDesc('reviews_avg_rating')
            ->take(8)->get();

        $popularSeries = TvSeries::withCount('reviews')
            ->orderByDesc('reviews_count')
            ->take(8)->get();

        return view('home', compact('topMovies', 'popularMovies', 'topSeries', 'popularSeries'));
    }

    public function search(\Illuminate\Http\Request $request)
    {
        $q = $request->input('q');
        $movies = Movie::where('title', 'like', "%$q%")->take(10)->get();
        $series = TvSeries::where('title', 'like', "%$q%")->take(10)->get();
        return view('search', compact('movies', 'series', 'q'));
    }
}