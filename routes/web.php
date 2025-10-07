<?php

use App\Models\Tour;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\admins\CityController;
use App\Http\Controllers\admins\AdminController;
use App\Http\Controllers\clients\BlogController;
use App\Http\Controllers\clients\FaqsController;
use App\Http\Controllers\clients\HomeController;
use App\Http\Controllers\clients\TourController;
use App\Http\Controllers\clients\AboutController;
use App\Http\Controllers\clients\LoginController;
use App\Http\Controllers\clients\GoogleController;
use App\Http\Controllers\admins\ListTourController;
use App\Http\Controllers\admins\ListTourGuide;
use App\Http\Controllers\admins\ListUserController;
use App\Http\Controllers\clients\BookingController;
use App\Http\Controllers\clients\ContactController;
use App\Http\Controllers\clients\GelleryController;
use App\Http\Controllers\clients\CheckOutController;
use App\Http\Controllers\clients\AuthClientController;
use App\Http\Controllers\clients\DestinationController;
use App\Http\Controllers\Clients\TravelGuidesController;

// Authentication Routes
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/register', [LoginController::class, 'register'])->name('register');
Route::post('/check-email', [LoginController::class, 'checkEmail'])->name('check.email');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
// Login with Google
Route::controller(GoogleController::class)->group(function(){
    Route::get('auth/google', 'redirectToGoogle')->name('auth.google');
    Route::get('auth/google/callback', 'handleGoogleCallback');
});



// routes/web.php
// Route::get('/test-mail', function () {
//     try {
//         Mail::raw('Test email content', function ($message) {
//             $message->to('vo581380@gmail.com')
//                     ->subject('Test Email Laravel');
//         });
//         return 'Email sent successfully!';
//     } catch (\Exception $e) {
//         return 'Error: ' . $e->getMessage();
//     }
// });


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tour', [TourController::class, 'index'])->name('tour');
Route::get('/tour-detail/{id}', [TourController::class, 'show'])->name('tour-detail');
Route::get('/tour-guide', [TravelGuidesController::class, 'index'])->name('tour-guide');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog-detail/{id}', [BlogController::class, 'show'])->name('blog-detail');
Route::get('/destination', [DestinationController::class, 'index'])->name('destination');
Route::get('/destination-detail', [DestinationController::class, 'show'])->name('destination-detail');
Route::get('/faqs', [FaqsController::class, 'index'])->name('faqs');
Route::get('/gellery', [GelleryController::class, 'index'])->name('gellery');
Route::get('/search', [TourController::class, 'search'])->name('search');
Route::get('/tours/filter', [TourController::class, 'filter'])->name('tour.filter');

// Thông tin cá nhân
Route::get('/profile', [AuthClientController::class, 'index'])->name('profile');
Route::post('/profile/update-avatar', [AuthClientController::class, 'updateAvatar'])->name('user.updateAvatar');
Route::put('/profile/update-detail/{id}', [AuthClientController::class, 'updateDetail'])->name('user.updateDetail');
Route::post('/profile/change-password', [AuthClientController::class, 'changePassword'])->name('user.changePassword');

// Checkout
Route::get('/booking/{id}', [BookingController::class, 'create'])->name('booking');
Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');

// history booking
Route::get('/history', [BookingController::class, 'history'])->name('history.booking');
Route::get('/cancel-booking/{id}', [BookingController::class, 'cancelBooking'])->name('cancel.booking');

// tìm kiếm tour
Route::post('search-tour',[TourController::class,'search'])->name('search.tour');



route::get('/404', function () {
    return view('layouts.client');
});


// LOGIN ADMIN =====================================================
Route::middleware(['admin'])->group(function () {
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::get('/admin',[AdminController::class,'index'])->name('admin.dashboard');
// users
Route::get('admin/users',[ListUserController::class,'index'])->name('admin.listUser');
Route::get('admin/users/edit/{id}',[ListUserController::class,'edit'])->name('admin.editUser');
Route::post('admin/users/edit/{id}',[ListUserController::class,'update'])->name('admin.updateUser');
// tour
Route::get('admin/tours',[ListTourController::class,'index'])->name('admin.listTour');
  Route::get('admin/tour/create', [ListTourController::class, 'create'])->name('admin.createTour');
  Route::post('admin/tour/store', [ListTourController::class, 'store'])->name('admin.storeTour');
Route::get('/admin/tours/{id}/edit', [ListTourController::class, 'edit'])->name('admin.editTour');
Route::put('/admin/tours/{id}/update', [ListTourController::class, 'update'])->name('admin.updateTour');

// tour guide
Route::get('admin/guides',[ListTourGuide::class,'index'])->name('admin.listGuide');
Route::get('admin/guide/create', [ListTourGuide::class, 'create'])->name('admin.createGuide');
Route::post('admin/guide/store', [ListTourGuide::class, 'store'])->name('admin.storeGuide');
Route::get('admin/guide/{guide}/edit', [ListTourGuide::class, 'edit'])->name('admin.editGuide');
Route::post('admin/guide/{guide}/update', [ListTourGuide::class, 'update'])->name('admin.updateGuide');



});

Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('loginadmin.post');

// API ROUTES lấy tỉnh miền add tour =====================================================
Route::prefix('api')->name('api.')->group(function () {
    Route::get('/cities', [CityController::class, 'getCitiesByDomain'])->name('cities.by-domain');
    Route::get('/cities/{id}', [CityController::class, 'show'])->name('cities.show');
});

// ADMIN =====================================================

