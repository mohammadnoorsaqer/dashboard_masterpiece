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
use App\Http\Controllers\DoctorsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\ManageAdminsController;
use App\Http\Controllers\UserAppointmentController;
use App\Http\Controllers\UserCouponController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserArticleController;
use App\Http\Controllers\PackageController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsUser;
use App\Models\Doctor;

use App\Http\Controllers\Admin\CommentController;
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Contact Routes
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
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

    // Admin Routes
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

    // Comment Routes
    Route::resource('comments', CommentController::class); // Resource route for comments
    // Updated route for updating the comment status
 Route::put('comments/{comment}/status', [CommentController::class, 'updateStatus'])->name('comments.updateStatus');    });


Route::get('/', function () {
    return view('user.home');
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
})->name('home');

Route::get('/about', function () {
    return view('user.about');
});

Route::get('/doctors', function () {
    // Fetch all doctors from the database
    $doctors = Doctor::all();

    // Pass doctors data to the view
    return view('user.doctors', compact('doctors'));
});
Route::get('/services', function () {
    return view('user.services');
});
Route::get('/pricing', function () {
    return view('user.pricing');
});
Route::get('/pricing', [PackageController::class, 'showPackages'])->name('user.packages');
Route::post('/appointments', [UserAppointmentController::class, 'store'])->name('appointments.store');
Route::get('/pricing', [UserAppointmentController::class, 'index'])->name('user.pricing');

Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

Route::get('/check-coupon', [UserCouponController::class, 'checkCoupon']);
Route::get('/articles', [UserArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{id}', [UserArticleController::class, 'show'])->name('article.show');

Route::get('/contact', function () {
    return view('user.contact');
});
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::middleware(['auth', 'isDoctor'])->group(function () {
    Route::get('/doctor/dashboard', [DoctorsController::class, 'dashboard'])->name('doctor.dashboard');
    Route::post('/doctor/appointments/{appointment}/update', [DoctorsController::class, 'updateAppointment'])->name('doctor.appointments.update');
});
Route::get('/appointments/{appointment}/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');

// Store the submitted review
Route::post('/reviews/store', [ReviewController::class, 'store'])->name('reviews.store');

require __DIR__.'/auth.php';
