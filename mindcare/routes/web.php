<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\ArticleController;

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::put('/reviews/{review}/status', [ReviewController::class, 'updateStatus'])->name('reviews.updateStatus');
    Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors.index'); // List doctors
    Route::get('/doctors/create', [DoctorController::class, 'create'])->name('doctors.create'); // Show form to create doctor
    Route::post('/doctors', [DoctorController::class, 'store'])->name('doctors.store'); // Store new doctor
    Route::get('/doctors/{doctor}/edit', [DoctorController::class, 'edit'])->name('doctors.edit'); // Edit doctor
    Route::put('/doctors/{doctor}', [DoctorController::class, 'update'])->name('doctors.update'); // Update doctor
    Route::delete('/doctors/{doctor}', [DoctorController::class, 'destroy'])->name('doctors.destroy'); // Delete doctor
    Route::get('/coupons', [CouponController::class, 'index'])->name('coupons.index');
    Route::get('/coupons/create', [CouponController::class, 'create'])->name('coupons.create');
    Route::post('/coupons', [CouponController::class, 'store'])->name('coupons.store');
    Route::get('/coupons/{coupon}/edit', [CouponController::class, 'edit'])->name('coupons.edit'); // Edit route
    Route::put('/coupons/{coupon}', [CouponController::class, 'update'])->name('coupons.update');
    Route::delete('/coupons/{coupon}', [CouponController::class, 'destroy'])->name('coupons.destroy'); // Delete route
    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index'); // List all appointments
    Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('appointments.create'); // Create appointment form
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store'); // Store new appointment
    Route::get('/appointments/{appointment}/edit', [AppointmentController::class, 'edit'])->name('appointments.edit'); // Edit appointment form
    Route::put('/appointments/{appointment}', [AppointmentController::class, 'update'])->name('appointments.update'); // Update appointment
    Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy'])->name('appointments.destroy'); // Delete appointment
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index'); // List all articles
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create'); // Create article form
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store'); // Store new article
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit'); // Edit article form
    Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update'); // Update article
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy'); // Delete article
    Route::get('/blog-posts', [BlogPostController::class, 'index'])->name('blog-posts.index'); // Display all blog posts
    Route::get('/blog-posts/create', [BlogPostController::class, 'create'])->name('blog-posts.create'); // Show create form
    Route::post('/blog-posts', [BlogPostController::class, 'store'])->name('blog-posts.store'); // Store new blog post
    Route::get('/blog-posts/{blogPost}/edit', [BlogPostController::class, 'edit'])->name('admin.blog-posts.edit');
    Route::put('/blog-posts/{blogPost}', [BlogPostController::class, 'update'])->name('blog-posts.update'); // Update blog post
    Route::delete('/blog-posts/{blogPost}', [BlogPostController::class, 'destroy'])->name('admin.blog-posts.destroy');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/coupons', [CouponController::class, 'index'])->name('coupons.index');
    Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/blog-posts', [BlogPostController::class, 'index'])->name('blog-posts.index');
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
