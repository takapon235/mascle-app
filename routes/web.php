<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\UserDetailsController;
use App\Http\Controllers\ExecutionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [UserDetailsController::class, 'index']);

Route::get('/dashboard',[UserDetailsController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// 筋トレ実行画
Route::get('/execution', [ExecutionController::class, 'show'])->middleware(['auth', 'verified'])->name('execution.execution');

Route::post('/training-end', [UserDetailsController::class, 'handleTrainingEnd'])->name('training.end');

Route::get('/training_memo', [UserDetailsController::class, 'createMemo'])->name('training.memo.form');
Route::post('/training_memo', [UserDetailsController::class, 'storeMemo'])->name('training.memo.store');

Route::get('/users/{id}', [UsersController::class, 'show'])->name('users.show');

Route::middleware('auth')->group(function() {
    Route::resource('users', UsersController::class, ['only' => ['show']]);
    Route::resource('user_details', UserDetailsController::class, ['only' => ['store', 'destroy', 'index']]);
});

require __DIR__.'/auth.php';
