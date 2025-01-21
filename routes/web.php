<?php


use App\Http\Controllers\GameController;
use App\Http\Controllers\WordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\navigationController;
use App\Http\Controllers\ScoreController;

// Gebruikersroutes
Route::middleware('auth')->group(function () {
    //Route::get('/player/home', [navigationController::class, 'playerHome'])->name('player.home');
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
Route::get('/level1_woordcode', function () {
    return view('level1_woordcode');
})->name('level1.woordcode');
Route::get('/popUp', function () {
    return view('popUp');
})->name('popUp');



Route::get('/end-game', [GameController::class, 'endGame'])->name('game.end');
Route::post('/save-score', [GameController::class, 'saveScore'])->name('save.score');


// Auth routes
Auth::routes();


Route::get('player/level2_math_quiz', function () {
    return view('level2_math_quiz');
});


Route::post('/save-score', [ScoreController::class, 'saveScore'])->middleware('auth');
>>>>>>>
Level2(Rekenraadsel)
