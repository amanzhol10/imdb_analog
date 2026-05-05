<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Actor extends Model
{
    protected $fillable = ['name', 'bio', 'birth_date', 'photo_path'];
    protected $casts = ['birth_date' => 'date'];

    public function movies(): BelongsToMany
    {
        return $this->belongsToMany(Movie::class, 'actor_movie')->withPivot('character');
    }

    public function tvSeries(): BelongsToMany
    {
        return $this->belongsToMany(TvSeries::class, 'actor_tv_series')->withPivot('character');
    }
}