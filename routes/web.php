<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\HomeController::class, 'all'])
    ->middleware(['auth', 'verified'])->name('home');

Route::get('/liked-posts', [\App\Http\Controllers\HomeController::class, 'likedPosts'])
    ->middleware(['auth', 'verified'])->name('likedPosts.home');


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::post('/post', [\App\Http\Controllers\PostController::class, 'store'])
    ->middleware(['auth', 'verified'])->name('store.post');

Route::post('/post/like', [\App\Http\Controllers\PostController::class, 'like'])
    ->middleware(['auth', 'verified'])->name('like.post');

Route::post('/post/unlike', [\App\Http\Controllers\PostController::class, 'unlike'])
    ->middleware(['auth', 'verified'])->name('unlike.post');

Route::delete('/post', [\App\Http\Controllers\PostController::class, 'destroy'])
    ->middleware(['auth', 'verified'])->name('destroy.post');


Route::post('/comment', [\App\Http\Controllers\CommentController::class, 'store'])
    ->middleware(['auth', 'verified'])->name('store.comment');

Route::delete('/comment', [\App\Http\Controllers\CommentController::class, 'destroy'])
    ->middleware(['auth', 'verified'])->name('destroy.comment');

require __DIR__ . '/auth.php';
