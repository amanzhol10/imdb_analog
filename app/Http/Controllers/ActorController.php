<?php
namespace App\Http\Controllers;

use App\Models\Actor;

class ActorController extends Controller
{
    public function index()
    {
        $actors = Actor::withCount(['movies', 'tvSeries'])->paginate(20);
        return view('actors.index', compact('actors'));
    }

    public function show(Actor $actor)
    {
        $actor->load('movies', 'tvSeries');
        return view('actors.show', compact('actor'));
    }
}