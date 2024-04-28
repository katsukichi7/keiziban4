<?php

use App\Http\Controllers\FavoriteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\ReplyController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('posts', PostController::class);
Route::resource('/',WebController::class);
Route::post('messages',[MessageController::class,'store'])->name('messages.store');
Route::resource('messages',MessageController::class);
// Route::resource('favorites',FavoriteController::class);
Route::get('/posts/favorite/message/{message}', [FavoriteController::class, 'message_favorite'])->name('message_favorite');
Route::get('/posts/favorite/reply/{reply}', [FavoriteController::class, 'reply_favorite'])->name('reply_favorite');
// Route::resource('replies',ReplyController::class);
Route::get('/posts/{post}/messages/{message}/replies/create/{reply?}', [ReplyController::class, 'create'])->name('replies.create');
Route::post('/posts/{post}/messages/{message}/replies', [ReplyController::class, 'store'])->name('replies.store');
Route::get('/posts/{post}/messages/{message}/replies/{reply?}',[ReplyController::class,'show'])->name('replies.show');
