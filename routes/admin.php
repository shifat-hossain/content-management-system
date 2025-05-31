<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth', 'admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('posts', PostController::class);
    Route::resource('categories', CategoryController::class);
    Route::get('/posts/review/{post}', [PostController::class, 'review'])->name('post_review');
    Route::get('/posts/approval-status/{post}/{status}', [PostController::class, 'change_approval_status'])->name('posts.approval_status');
});