<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
})->middleware('guest')->name('login');

Route::get('/register', function () {
    return view('register');
})->middleware('guest')->name('register');


Route::name('user.')->prefix('user')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('posts', PostController::class);
    Route::post('/posts/change-status', [PostController::class, 'change_status'])->name('posts.change_status');
    Route::get('/posts/delete-posts/list', [PostController::class, 'deleted_posts'])->name('posts.delete_posts');
    Route::get('/posts/{post}/restore', [PostController::class, 'restore'])->name('posts.restore');
    Route::delete('/posts/{post}/permenant-delete', [PostController::class, 'permenant_delete'])->name('posts.permenant_delete');
});

Route::middleware('auth')->group(function () {
    Route::post('/posts/image-upload', [ImageController::class, 'upload'])->name('posts.image_upload');
    Route::post('/posts/unlink-image', [ImageController::class, 'unlink_image'])->name('posts.unlink_image');
});
