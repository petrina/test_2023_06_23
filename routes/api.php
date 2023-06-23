<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\NewsController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('posts')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('allPosts');
    Route::post('/', [PostController::class, 'store']);
    Route::get('/{post}', [PostController::class, 'show']);
    Route::get('/{post}/{language}', [PostController::class, 'showPostTranslation']);
    Route::put('/{post}/{language}', [PostController::class, 'updatePostTranslation']);
    Route::delete('/{post}', [PostController::class, 'destroy']);
});

Route::prefix('tags')->group(function () {
    Route::get('/', [TagController::class, 'index'])->name('allTags');
    Route::post('/', [TagController::class, 'store']);
    Route::get('/{tag}', [TagController::class, 'show']);
    Route::put('/{tag}', [TagController::class, 'update']);
    Route::delete('/{tag}', [TagController::class, 'destroy']);
});
Route::post('/search', [NewsController::class, 'search'])->name('search');

