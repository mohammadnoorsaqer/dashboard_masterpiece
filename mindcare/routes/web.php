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
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\ManageAdminsController;
use App\Http\Controllers\UserAppointmentController;
use App\Http\Controllers\UserCouponController;
use App\Http\Controllers\ContactController;

use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsUser;
use App\Http\Controllers\Admin\CommentController;
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard route

    // Route to store a new comment
    Route::post('admin/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('admin/articles/{articleId}/comments', [CommentController::class, 'show'])->name('comments.show');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    //conctacts
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index'); // Contact page
    Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store'); // Store contact form (if you plan to have form submissions)
    Route::put('contacts/{contact}/status', [ContactController::class, 'updateStatus'])->name('contacts.updateStatus');


    // Doctor Routes
    Route::resource('doctors', DoctorController::class);
    
    // Coupon Routes
    Route::resource('coupons', CouponController::class);
    
    // Appointment Routes
    Route::resource('appointments', AppointmentController::class);
    Route::put('appointments/{id}/update-status', [AppointmentController::class, 'updateStatus'])->name('appointments.updateStatus');
    // Article Routes
    Route::resource('articles', ArticleController::class);
    
    // Review Routes
    Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
    Route::put('/reviews/{review_id}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::get('manageadmins', [ManageAdminsController::class, 'index'])->name('manageadmins.index');
    Route::get('manageadmins/create', [ManageAdminsController::class, 'create'])->name('manageadmins.create');
    Route::post('manageadmins', [ManageAdminsController::class, 'store'])->name('manageadmins.store');
    Route::get('manageadmins/{id}/edit', [ManageAdminsController::class, 'edit'])->name('manageadmins.edit');
    Route::put('manageadmins/{id}', [ManageAdminsController::class, 'update'])->name('manageadmins.update');
    Route::delete('manageadmins/{id}', [ManageAdminsController::class, 'destroy'])->name('manageadmins.destroy');
    // User Routes
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::put('users/{id}/activate', [UserController::class, 'activate'])->name('users.activate');
    Route::put('users/{id}/deactivate', [UserController::class, 'deactivate'])->name('users.deactivate');
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
Route::get('/home', function () {
    return view('user.home');
});

Route::get('/about', function () {
    return view('user.about');
});

Route::get('/doctors', function () {
    return view('user.doctors');
});
Route::get('/services', function () {
    return view('user.services');
});
Route::get('/pricing', function () {
    return view('user.pricing');
});
Route::post('/book-appointment', [UserAppointmentController::class, 'bookAppointment'])->name('user.bookAppointment');

Route::get('/check-coupon', [UserCouponController::class, 'checkCoupon']);

Route::get('/articles', function () {
    return view('user.articles');
});
Route::get('/contact', function () {
    return view('user.contact');
});
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


require __DIR__.'/auth.php';
