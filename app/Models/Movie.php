<?php
namespace App\Models;

use ApiPlatform\Metadata\ApiResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[ApiResource]
#[Fillable(['title', 'description', 'year', 'director', 'poster_path'])]
class Movie extends Model
{
    protected $casts = ['year' => 'integer'];

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function actors(): BelongsToMany
    {
        return $this->belongsToMany(Actor::class, 'actor_movie')->withPivot('character');
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class, 'genre_movie');
    }
}