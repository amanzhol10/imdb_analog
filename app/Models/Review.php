<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    protected $fillable = ['user_id', 'movie_id', 'tv_series_id', 'rating', 'content'];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }
    public function tvSeries(): BelongsTo
    {
        return $this->belongsTo(TvSeries::class);
    }
}
