<?php


use App\Http\Controllers\GameController;
use App\Http\Controllers\WordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\navigationController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\MazeScoreController;


// Auth routes
Auth::routes();

// Other routes
Route::view('/', 'home')->name('home');
Route::view('/home', 'home')->name('home');
Route::get('/admin/admin_home', [AdminController::class, 'index'])->name('admin_home');
Route::get('/player/player_home', [AdminController::class, 'index'])->name('player_home');
Route::post('/logout', [navigationController::class, 'logout'])->middleware('auth')->name('logout');
Route::get('/login', [navigationController::class, 'login'])->name('login');

// Player & Admin profile routes
Route::middleware('auth')->group(function () {
    Route::get('/user/profile/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/profile/update', [UserController::class, 'update'])->name('user.update');
    Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
});

// Admin routes
Route::middleware(['admin'])->group(function () {
    //Route::get('/admin/home', [AdminController::class, 'index'])->name('admin_home');
    Route::get('/admin/profile/edit', [AdminController::class, 'edit'])->name('admin_edit');
    Route::put('/admin/profile/update', [AdminController::class, 'update'])->name('admin.update');
});

//Routes for level1
Route::get('/popUp', function () { return view('popUp');})->name('popUp');
Route::get('/level1_woordcode', [GameController::class, 'index'])->name('game.index');
Route::post('/level1_woordcode/checkAnswer', [GameController::class, 'checkAnswer'])->name('game.checkAnswer');
Route::get('/level1_woordcode/nextWord', [GameController::class, 'nextWord'])->name('game.nextWord');
Route::get('/end-game', [GameController::class, 'endGame'])->name('game.end');
Route::post('/save-score', [GameController::class, 'saveScore'])->name('save.score');

Route::get('/player/level2_math_quiz', function () {
    return view('level2_math_quiz');
})->name('next-game');


