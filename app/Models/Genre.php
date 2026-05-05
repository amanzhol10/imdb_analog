<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Genre extends Model
{
    protected $fillable = ['name', 'slug', 'description'];

    public function movies(): BelongsToMany
    {
        return $this->belongsToMany(Movie::class, 'genre_movie');
    }

    public function tvSeries(): BelongsToMany
    {
        return $this->belongsToMany(TvSeries::class, 'genre_tv_series');
    }
}