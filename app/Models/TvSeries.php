<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TvSeries extends Model
{
    protected $fillable = ['title', 'description', 'year', 'director', 'poster_path', 'seasons', 'status'];

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function actors(): BelongsToMany
    {
        return $this->belongsToMany(Actor::class, 'actor_tv_series')->withPivot('character');
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'genre_tv_series');
    }
}