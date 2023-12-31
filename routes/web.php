<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Livewire\FormNews;
use App\Livewire\EditNews;
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

Route::get('/', [Controllers\BaseController::class, 'getIndex']);
Route::get('/album', [Controllers\BaseController::class, 'getIndex']);
Route::get('/blog', [Controllers\NewsController::class, 'getIndex'])->name('news');
Route::get('article/{article}', [Controllers\NewsController::class, 'getOne']);
Route::get('/albums', [Controllers\AlbumController::class, 'getIndex'])->name('albums');
Route::get('album/{album}', [Controllers\AlbumController::class, 'getOne']);

Route::get('product/{product}', [Controllers\AlbumController::class, 'getProduct']);
Route::get('product/{product}/likes', [Controllers\AlbumController::class, 'likes']);
Route::get('product/{product}/like_del', [Controllers\AlbumController::class, 'like_del']);
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::post('album', [Controllers\AlbumController::class, 'postIndex']);
    Route::post('/album/{album}/product_add', [Controllers\AlbumController::class, 'postProduct']);
    Route::get('/album/{album}/edit', [Controllers\AlbumController::class, 'getEdit']);
    Route::post('/album/{album}/edit', [Controllers\AlbumController::class, 'postEdit']);
    Route::get('/album/{album}/delete', [Controllers\AlbumController::class, 'getDelete']);
    Route::post('/product/{product}/comment_add', [Controllers\AlbumController::class, 'postComment']);
    Route::post('/product/{product}/likes_add', [Controllers\AlbumController::class, 'postLike']);
    Route::get('/product/{product}/delete', [Controllers\AlbumController::class, 'getProductDelete']);
    //Route::get('/my_news/', [Controllers\NewsController::class, 'myNews'])->name('my_news');
    Route::get('/my_news/', FormNews::class)->name('my_news');
    Route::get('/my_news/{article}/edit', EditNews::class);

    Route::prefix('ajax')->group(function (){
        Route::get('album/{album}', [Controllers\AlbumController::class, 'getAjaxAlbum']);
    });

    Route::post('editor/{article_id}/image_upload', [Controllers\EditorController::class, 'upload'])->name('upload');
});
