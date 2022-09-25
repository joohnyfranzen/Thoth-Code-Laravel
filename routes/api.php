<?php

use App\Http\Controllers\Api\AuthController;
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

// Login Route
Route::post('login', [AuthController::class, 'login'])->name('login');

// Register Route
Route::post('user', [AuthController::class, 'store'])->name('user');

// Post unprotected Routes
Route::get('post', [PostControlller::class, 'index'])->name('post');
Route::get('post/:id', [PostControlller::class, 'show'])->name('post');

// Protected Routes
Route::middleware('auth:sanctum')->group(function() {

    // Post Resource Routes
    Route::Resource('post', PostController::class)->except('index', 'show', 'create', 'edit');

    
});
