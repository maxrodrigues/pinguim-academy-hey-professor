<?php

use App\Http\Controllers\Question;
use App\Http\Controllers\{ProfileController, QuestionController};
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (app()->isLocal()) {
        auth()->loginUsingId(1);

        return redirect()->route('dashboard');
    }

    return view('welcome');
});

Route::get('/dashboard', \App\Http\Controllers\DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::post('questions/store', [QuestionController::class, 'store'])->name('questions.store');
Route::post('question/like/{question}', Question\LikeController::class)->name('questions.like');
Route::post('question/unlike/{question}', Question\UnLikeController::class)->name('questions.unlike');
Route::put('question/publish/{question}', Question\PublishController::class)->name('questions.publish');
