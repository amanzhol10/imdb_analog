<?php
namespace App\Http\Controllers;

use App\Models\Genre;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::withCount(['movies', 'tvSeries'])->get();
        return view('genres.index', compact('genres'));
    }

    public function show(Genre $genre)
    {
        $genre->load('movies', 'tvSeries');
        return view('genres.show', compact('genre'));
    }
}