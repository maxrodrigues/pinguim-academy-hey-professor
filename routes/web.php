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
    #region Profile Controller
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    #endregion

    #region Questions Controller
    Route::group(['prefix' => 'questions', 'as' => 'questions.'], function () {
        Route::get('/', [QuestionController::class, 'index'])->name('index');
        Route::post('store', [QuestionController::class, 'store'])->name('store');
        Route::post('like/{question}', Question\LikeController::class)->name('like');
        Route::post('unlike/{question}', Question\UnLikeController::class)->name('unlike');
        Route::put('publish/{question}', Question\PublishController::class)->name('publish');
    });
    #endregion

});

require __DIR__ . '/auth.php';
