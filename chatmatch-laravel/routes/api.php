<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

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
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/profil', [AuthController::class, 'edit'])->name('profil.edit')->middleware("auth:sanctum");
Route::put('/profil', [AuthController::class, 'update'])->name('profil.update')->middleware("auth:sanctum");

Route::post('/post',[PostController::class, 'store'])->name('post.store')->middleware("auth:sanctum");
Route::get('/post',[PostController::class, 'index'])->name('post.index')->middleware("auth:sanctum");

Route::post('/comment',[CommentController::class, 'store'])->name('comment.store')->middleware("auth:sanctum");
Route::get('/comment',[CommentController::class, 'index'])->name('comment.index')->middleware("auth:sanctum");


Route::get('/users/search',[SearchController::class, 'search'])->name('search.index')->middleware("auth:sanctum");




