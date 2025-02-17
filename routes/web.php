<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;

Route::get('/',[MainController::class,'dashboard'])->name('home');
Route::get('Mainpage',[MainController::class,'index'])->name('main');

Route::middleware('post')->group(function () {
Route::get('/register',[AuthController::class,'registerForm'])->name('registerForm');//->middleware('post');
Route::get('/email-verify',[AuthController::class,'emailVerify'])->name('email.verify');
Route::post('/register',[AuthController::class,'register'])->name('register');
Route::get('/login',[AuthController::class,'loginForm'])->name('loginForm');//->middleware('post');
Route::post('login',[AuthController::class,'login'])->name('login');
});

Route::middleware('register')->group(function () {
Route::get('edituser/{id}',[AuthController::class,'editForm'])->name('editprofile');
Route::put('updateuser', [AuthController::class,'update'])->name('update.profile');
Route::get('/user/profile/{id}',[AuthController::class,'userprofile'])->name('users.profile');
Route::delete('/logout',[AuthController::class,'logout'])->name('logout');
Route::get('my/profile',[AuthController::class,'my_profile'])->name('my.profile');
Route::post( '/comments/store', [CommentController::class, 'store'])->name('comments.store');
Route::delete( '/comments/destroy/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
Route::patch('/read/notify{id}', [NotificationController::class,'readNotify'])->name('mark.notification.read');
Route::resource( '/posts', PostController::class);


Route::post('/follow/{user}',[FollowController::class,'follow'])->name('follow');
Route::delete('/follow/{id}', [FollowController::class, 'unfollow'])->name('unfollow');
Route::get('/notify',[FollowController::class,'notify'])->name('notify');
});

Route::get('/posts', [PostController::class,'index'])->name('posts.index');
Route::get('/posts/{post}', [PostController::class,'show'])->name('posts.show');