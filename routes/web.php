<?php

use App\Models\Tour;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\admins\ListFaqs;
use App\Http\Controllers\admins\ListTourGuide;
use App\Http\Controllers\admins\CityController;
use App\Http\Controllers\admins\AdminController;
use App\Http\Controllers\clients\BlogController;
use App\Http\Controllers\clients\FaqsController;
use App\Http\Controllers\clients\HomeController;
use App\Http\Controllers\clients\TourController;
use App\Http\Controllers\admins\ListActivityIcon;
use App\Http\Controllers\clients\AboutController;
use App\Http\Controllers\clients\LoginController;
use App\Http\Controllers\clients\GoogleController;
use App\Http\Controllers\admins\ListTourController;
use App\Http\Controllers\admins\ListUserController;
use App\Http\Controllers\clients\BookingController;
use App\Http\Controllers\clients\ContactController;
use App\Http\Controllers\clients\GelleryController;
use App\Http\Controllers\admins\ListBookingCheckout;
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
Route::controller(GoogleController::class)->group(function () {
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
Route::post('search-tour', [TourController::class, 'search'])->name('search.tour');



route::get('/404', function () {
    return view('layouts.client');
});


// LOGIN ADMIN =====================================================
Route::middleware(['admin'])->group(function () {
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    // users
    Route::get('admin/users', [ListUserController::class, 'index'])->name('admin.listUser');
    Route::get('admin/users/edit/{id}', [ListUserController::class, 'edit'])->name('admin.editUser');
    Route::post('admin/users/edit/{id}', [ListUserController::class, 'update'])->name('admin.updateUser');
    // tour
    Route::get('admin/tours', [ListTourController::class, 'index'])->name('admin.listTour');
    Route::get('admin/tour/create', [ListTourController::class, 'create'])->name('admin.createTour');
    Route::post('admin/tour/store', [ListTourController::class, 'store'])->name('admin.storeTour');
    Route::get('/admin/tours/{id}/edit', [ListTourController::class, 'edit'])->name('admin.editTour');
    Route::put('/admin/tours/{id}/update', [ListTourController::class, 'update'])->name('admin.updateTour');

    // tour guide
    Route::get('admin/guides', [ListTourGuide::class, 'index'])->name('admin.listGuide');
    Route::get('admin/guide/create', [ListTourGuide::class, 'create'])->name('admin.createGuide');
    Route::post('admin/guide/store', [ListTourGuide::class, 'store'])->name('admin.storeGuide');
    Route::get('admin/guide/{guide}/edit', [ListTourGuide::class, 'edit'])->name('admin.editGuide');
    Route::post('admin/guide/{guide}/update', [ListTourGuide::class, 'update'])->name('admin.updateGuide');


    // Danh sách câu hỏi
    Route::get('admin/faqs', [ListFaqs::class, 'index'])->name('admin.listFaqs');
    Route::get('admin/faqs/create', [ListFaqs::class, 'create'])->name('admin.createFaqs');
    Route::post('admin/faqs/store', [ListFaqs::class, 'store'])->name('admin.storeFaqs');
    Route::get('admin/faqs/{faq}/edit', [ListFaqs::class, 'edit'])->name('admin.editFaqs');
    Route::put('admin/faqs/{faq}/update', [ListFaqs::class, 'update'])->name('admin.updateFaqs');
    Route::delete('admin/faqs/{faq}/delete', [ListFaqs::class, 'destroy'])->name('admin.deleteFaqs');
    Route::get('admin/faqs/trash', [ListFaqs::class, 'trash'])->name('admin.trashFaqs');
    Route::post('admin/faqs/{faq}/restore', [ListFaqs::class, 'restore'])->name('admin.restoreFaqs');
    Route::delete('admin/faqs/{faq}/force-delete', [ListFaqs::class, 'forceDelete'])->name('admin.forceDeleteFaqs');


    // icon hoạt động
    Route::get('admin/icon', [ListActivityIcon::class, 'index'])->name('admin.listIcon');
    Route::get('admin/icon/create', [ListActivityIcon::class, 'create'])->name('admin.createIcon');
    Route::post('admin/icon/store', [ListActivityIcon::class, 'store'])->name('admin.storeIcon');
    Route::get('admin/icon/{icon}/edit', [ListActivityIcon::class, 'edit'])->name('admin.editIcon');
    Route::put('admin/icon/{icon}/update', [ListActivityIcon::class, 'update'])->name('admin.updateIcon');
    Route::delete('admin/icon/{icon}/delete', [ListActivityIcon::class, 'destroy'])->name('admin.deleteIcon');
    Route::get('admin/icon/trash', [ListActivityIcon::class, 'trash'])->name('admin.trashIcon');
    Route::post('admin/icon/{icon}/restore', [ListActivityIcon::class, 'restore'])->name('admin.restoreIcon')->withTrashed();
    Route::delete('admin/icon/{icon}/force-delete', [ListActivityIcon::class, 'forceDelete'])->name('admin.forceDeleteIcon')->withTrashed();


    // booking
    Route::get('admin/booking', [ListBookingCheckout::class, 'index'])->name('admin.listBooking');
    Route::get('admin/{booking}', [ListBookingCheckout::class, 'show'])->name('admin.showBooking');
    Route::put('admin/booking/{booking}/update-status', [ListBookingCheckout::class, 'updateStatus'])->name('admin.updateStatusBooking');
    
    Route::get('admin/booking/trash', [ListBookingCheckout::class, 'trash'])->name('admin.trashBooking');
    Route::delete('admin/{booking}', [ListBookingCheckout::class, 'destroy'])->name('admin.deleteBooking');
    Route::put('admin/booking/{booking}/restore', [ListBookingCheckout::class, 'restore'])->name('admin.restoreBooking')->withTrashed();
});

Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('loginadmin.post');

// API ROUTES lấy tỉnh miền add tour =====================================================
Route::prefix('api')->name('api.')->group(function () {
    Route::get('/cities', [CityController::class, 'getCitiesByDomain'])->name('cities.by-domain');
    Route::get('/cities/{id}', [CityController::class, 'show'])->name('cities.show');
});

// ADMIN =====================================================
