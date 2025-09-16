<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\clients\BlogController;
use App\Http\Controllers\clients\FaqsController;
use App\Http\Controllers\clients\HomeController;
use App\Http\Controllers\clients\TourController;
use App\Http\Controllers\clients\AboutController;
use App\Http\Controllers\clients\LoginController;
use App\Http\Controllers\clients\ContactController;
use App\Http\Controllers\clients\GelleryController;
use App\Http\Controllers\clients\DestinationController;
use App\Http\Controllers\Clients\TravelGuidesController;

// Route::get('/', function () {
//     return view('clients.blocks.home');
// });

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/register', [LoginController::class, 'register'])->name('register');






Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tour',[TourController::class, 'index'])->name('tour');
Route::get('/tour-detail/{id}',[TourController::class, 'show'])->name('tour-detail');
Route::get('/tour-guide',[TravelGuidesController::class, 'index'])->name('tour-guide');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact',[ContactController::class, 'index'])->name('contact');
Route::get('/blog',[BlogController::class, 'index'])->name('blog');
Route::get('/blog-detail/{id}',[BlogController::class, 'show'])->name('blog-detail');
Route::get('/destination',[DestinationController::class, 'index'])->name('destination');
Route::get('/destination-detail',[DestinationController::class, 'show'])->name('destination-detail');
Route::get('/faqs',[FaqsController::class, 'index'])->name('faqs');
Route::get('/gellery',[GelleryController::class, 'index'])->name('gellery');

route::get('/404', function () {
    return view('clients.404');
});
