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
    return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');

//POST
//Route::get('/posts/{username}', [\App\Http\Controllers\PostController::class, 'all'])
//    ->middleware(['auth', 'verified'])->name('all.post');

Route::get('/post/{username}/{postId}', [\App\Http\Controllers\PostController::class, 'show'])
    ->middleware(['auth', 'verified'])->name('show.post');

Route::post('/post', [\App\Http\Controllers\PostController::class, 'store'])
    ->middleware(['auth', 'verified'])->name('store.post');

Route::post('/post/like', [\App\Http\Controllers\PostController::class, 'like'])
    ->middleware(['auth', 'verified'])->name('like.post');

Route::post('/post/unlike', [\App\Http\Controllers\PostController::class, 'unlike'])
    ->middleware(['auth', 'verified'])->name('unlike.post');

Route::delete('/post', [\App\Http\Controllers\PostController::class, 'destroy'])
    ->middleware(['auth', 'verified'])->name('destroy.post');

//COMMENTS
Route::post('/comment', [\App\Http\Controllers\CommentController::class, 'store'])
    ->middleware(['auth', 'verified'])->name('store.comment');

Route::post('/comment/like', [\App\Http\Controllers\CommentController::class, 'like'])
    ->middleware(['auth', 'verified'])->name('like.comment');

Route::post('/comment/unlike', [\App\Http\Controllers\CommentController::class, 'unlike'])
    ->middleware(['auth', 'verified'])->name('unlike.comment');

Route::delete('/comment', [\App\Http\Controllers\CommentController::class, 'destroy'])
    ->middleware(['auth', 'verified'])->name('destroy.comment');


//PROFILE
Route::get('/profile/{username}', [\App\Http\Controllers\ProfileController::class, 'show'])
    ->middleware(['auth', 'verified'])->name('show.profile');
Route::get('/profile/{username}/friends', [\App\Http\Controllers\ProfileController::class, 'show'])
    ->middleware(['auth', 'verified'])->name('show.profile.friends');
Route::get('/profile/{username}/edit', [\App\Http\Controllers\ProfileController::class, 'edit'])
    ->middleware(['auth', 'verified'])->name('edit.profile');
Route::post('/profile/{username}/edit', [\App\Http\Controllers\ProfileController::class, 'update'])
    ->middleware(['auth', 'verified'])->name('update.profile');
Route::post('/profile/deactivate', [\App\Http\Controllers\ProfileController::class, 'deactivate'])
    ->middleware(['auth', 'verified'])->name('deactivate.profile');
Route::get('/profile/{username}/friends/requests', [\App\Http\Controllers\ProfileController::class, 'show'])
    ->middleware(['auth', 'verified'])->name('show.profile.friends.request');
Route::get('/profile/{username}/about', [\App\Http\Controllers\ProfileController::class, 'show'])
    ->middleware(['auth', 'verified'])->name('show.profile.about');

//FRIENDS
Route::post('/friends/confirm', [\App\Http\Controllers\FriendController::class, 'confirm'])
    ->middleware(['auth', 'verified'])->name('confirm.friend');
Route::post('/friends/add', [\App\Http\Controllers\FriendController::class, 'addFriend'])
    ->middleware(['auth', 'verified'])->name('addFriend.friend');
Route::post('/friends/remove', [\App\Http\Controllers\FriendController::class, 'unfriend'])
    ->middleware(['auth', 'verified'])->name('unfriend.friend');


//MESSAGES
Route::get('/messages/{friendUsername}', [\App\Http\Controllers\ChatsController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('messages');
Route::get('/messages/fetch', [\App\Http\Controllers\ChatsController::class, 'fetch'])
    ->middleware(['auth', 'verified'])->name('fetch.messages');
Route::post('/messages/send', [\App\Http\Controllers\ChatsController::class, 'send'])
    ->middleware(['auth', 'verified'])->name('send.messages');


//SEARCH
Route::get('/search', [\App\Http\Controllers\SearchController::class, 'search'])
    ->middleware(['auth', 'verified'])->name('search');

//JOBS
Route::get('/jobs', [\App\Http\Controllers\JobController::class, 'all'])
    ->middleware(['auth', 'verified'])->name('all.jobs');
Route::post('/jobs', [\App\Http\Controllers\JobController::class, 'store'])
    ->middleware(['auth', 'admin','verified'])->name('store.jobs');
Route::post('/jobs/edit', [\App\Http\Controllers\JobController::class, 'update'])
    ->middleware(['auth', 'admin','verified'])->name('update.jobs');
Route::delete('/jobs', [\App\Http\Controllers\JobController::class, 'destroy'])
    ->middleware(['auth', 'admin','verified'])->name('destroy.jobs');


//ADMIN
Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'all'])
    ->middleware(['auth', 'admin', 'verified'])->name('admin');
Route::get('/admin/reported-users', [\App\Http\Controllers\AdminController::class, 'all'])
    ->middleware(['auth', 'admin', 'verified'])->name('reportedUsers.admin');
Route::get('/admin/jobs', [\App\Http\Controllers\AdminController::class, 'all'])
    ->middleware(['auth', 'admin', 'verified'])->name('jobs.admin');
Route::post('/admin/make', [\App\Http\Controllers\AdminController::class, 'makeAdmin'])
    ->middleware(['auth', 'admin', 'verified'])->name('makeAdmin.admin');
Route::post('/admin/remove', [\App\Http\Controllers\AdminController::class, 'removeAdmin'])
    ->middleware(['auth', 'admin', 'verified'])->name('removeAdmin.admin');

require __DIR__ . '/auth.php';
