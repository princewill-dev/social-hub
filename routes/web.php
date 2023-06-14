<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowController;

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

Route::get('/', [UserController::class, 'homeContent'])->name("login");
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->middleware("auth");


//blog routes starts here

Route::get('/create-post', [BlogController::class, 'createPost'])->middleware("auth");
Route::post('/create', [BlogController::class, 'savePost'])->middleware("auth");
Route::get('/post/{post}', [BlogController::class, 'singlePost']);
Route::delete('/post/{post}', [BlogController::class, 'deletePost'])->middleware("can:delete,post");
Route::get('/post/{post}/edit', [BlogController::class, 'editPost'])->middleware("auth");
Route::put('/post/{post}/edit', [BlogController::class, 'savedEditPost'])->middleware("can:update,post");

Route::get('/profile/{user:username}', [UserController::class, 'profile'])->middleware("auth");


//gate
Route::get('/admin-login', function(){
    return 'Only admin can view this page';
})->middleware('can:visitAdminPage');


Route::get('/profile-upload', [UserController::class, 'uploadProfile'])->middleware("auth");
Route::post('/profile-upload', [UserController::class, 'saveImage'])->middleware("auth");
Route::post('/create-follow/{user:username}', [FollowController::class, 'createFollow']);
Route::post('/remove-follow/{user:username}', [FollowController::class, 'removeFollow']);

Route::get('/profile/{user:username}/follower', [UserController::class, 'profileFollowers']);

Route::get('/profile/{user:username}/following', [UserController::class, 'profileFollowing']);