<?php

namespace App\Models;

use ApiPlatform\Metadata\ApiResource;
use Illuminate\Database\Eloquent\Model;

#[ApiResource]
class Movie extends Model
{
    protected $fillable = ['title', 'description', 'year', 'director'];

    protected $casts = [
        'year' => 'integer',
    ];
}