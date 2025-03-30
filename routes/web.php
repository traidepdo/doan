<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SearchController;

use Illuminate\Support\Facades\Route;

/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
|
| Đây là nơi bạn có thể đăng ký các route web cho ứng dụng của mình.
| Các route này sẽ được nạp bởi RouteServiceProvider và tất cả chúng
| sẽ được gán cho nhóm middleware "web".
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route cho trang dashboard của user
Route::get('/dashboard', function () {
    return view('user.dashboard');
})->middleware(['auth', 'verified'])->name('user.dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('user.home');
    Route::get('/search', [SearchController::class, 'index'])->name('user.search');// Tìm kiếm
    Route::get('/watch/{id}', [HomeController::class, 'watch'])->name('watch'); 
    Route::post('/video/{id}/like', [LikeController::class, 'toggleLike'])->name('video.like');
    Route::post('/video/{id}/comment', [CommentController::class, 'store'])->name('video.comment');
});

// Các route dành cho người dùng đã đăng nhập
Route::middleware('auth')->group(function () {
    // Route cho trang chỉnh sửa profile của người dùng
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Các route dành riêng cho admin
use App\Http\Controllers\Admin\VideoController;

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [VideoController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/videos', [VideoController::class, 'index'])->name('admin.videos.index');
    Route::get('/admin/videos/create', [VideoController::class, 'create'])->name('admin.videos.create');
    Route::post('/admin/videos', [VideoController::class, 'store'])->name('admin.videos.store');
    Route::get('/admin/videos/{id}/edit', [VideoController::class, 'edit'])->name('admin.videos.edit'); // Đảm bảo dòng này có
    Route::put('/admin/videos/{id}', [VideoController::class, 'update'])->name('admin.videos.update');
    Route::delete('/admin/videos/{id}', [VideoController::class, 'destroy'])->name('admin.videos.destroy');
});

// Thêm route vào auth.php
require __DIR__.'/auth.php'; 

