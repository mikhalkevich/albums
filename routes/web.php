<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
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

Route::get('/', [Controllers\AlbumController::class, 'getIndex']);
Route::get('/albums', [Controllers\AlbumController::class, 'getIndex'])->name('albums');
Route::get('album/{album}', [Controllers\AlbumController::class, 'getOne']);
Route::get('product/{product}', [Controllers\AlbumController::class, 'getProduct']);
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
    Route::post('/product/{product}/comment_add', [Controllers\AlbumController::class, 'postComment']);
    Route::post('/product/{product}/likes_add', [Controllers\AlbumController::class, 'postLike']);
});
