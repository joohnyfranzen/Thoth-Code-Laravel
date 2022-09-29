<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostCommentController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Login unprotected Route
Route::post('login', [AuthController::class, 'login'])->name('login');

// Register unprotected Route
Route::post('user', [AuthController::class, 'store'])->name('user');

// Post unprotected Routes
Route::get('post', [PostController::class, 'index'])->name('post');
Route::get('post/{id}', [PostController::class, 'show'])->name('post');

// Protected Routes
Route::middleware('auth:sanctum')->group(function() {

    Route::resource('/user', AuthController::class)->except('create', 'edit', 'store', 'update');
    Route::put('/user/{id}', [AuthController::class, 'update']);

    // Post Resource Routes
    Route::resource('/post', PostController::class)->except('index', 'show', 'create', 'edit');

    Route::get('/myposts', [PostController::class, 'userIndex'])->name('myposts');

    Route::resource('/postcomment', PostCommentController::class);
});
