<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\TvSeriesController;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\LocaleController;

// Home & Search
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');

// Language switcher
Route::get('/locale/{locale}', [LocaleController::class, 'switch'])->name('locale.switch');

// Auth
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Dashboard
Route::get('/dashboard', fn() => view('dashboard'))->middleware(['auth', 'verified'])->name('dashboard');

// Movies (public)
Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
Route::get('/movies/{movie}', [MovieController::class, 'show'])->name('movies.show');

// TV Series (public)
Route::get('/tv-series', [TvSeriesController::class, 'index'])->name('tv-series.index');
Route::get('/tv-series/{tvSeries}', [TvSeriesController::class, 'show'])->name('tv-series.show');

// Actors (public)
Route::get('/actors', [ActorController::class, 'index'])->name('actors.index');
Route::get('/actors/{actor}', [ActorController::class, 'show'])->name('actors.show');

// Genres (public)
Route::get('/genres', [GenreController::class, 'index'])->name('genres.index');
Route::get('/genres/{genre}', [GenreController::class, 'show'])->name('genres.show');

// Reviews (public index)
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');

// User profile (public)
Route::get('/users/{user}', [ProfileController::class, 'show'])->name('profile.show');

// Auth-protected routes
Route::middleware(['auth'])->group(function () {
    // Profile edit
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Reviews CRUD
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
    Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');

    // Admin: Movies
    Route::middleware(['role:admin|super-admin'])->group(function () {
        Route::delete('/movies/{movie}', [MovieController::class, 'destroy'])->name('movies.destroy');
        Route::delete('/tv-series/{tvSeries}', [TvSeriesController::class, 'destroy'])->name('tv-series.destroy');
    });

    Route::middleware(['permission:create movies'])->group(function () {
        Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create');
        Route::post('/movies', [MovieController::class, 'store'])->name('movies.store');
        Route::get('/tv-series/create', [TvSeriesController::class, 'create'])->name('tv-series.create');
        Route::post('/tv-series', [TvSeriesController::class, 'store'])->name('tv-series.store');
    });

    Route::middleware(['permission:edit movies'])->group(function () {
        Route::get('/movies/{movie}/edit', [MovieController::class, 'edit'])->name('movies.edit');
        Route::put('/movies/{movie}', [MovieController::class, 'update'])->name('movies.update');
    });
});

Route::get('/mail/send', [MailController::class, 'send'])->name('mail.send');