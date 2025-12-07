<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscribersController;
use App\Http\Controllers\ThemeController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';
Route::controller(ThemeController::class)->name('theme.')->group(function () { 
    Route::get('/','index')->name('index');
    Route::get('/category','category')->name('category');
    Route::get('/contact','contact')->name('contact');
    Route::get('/single-log','singleBlog')->name('singleBlog');
});

Route::post('/subscriber',[SubscribersController::class,'store'])->name('subscriber.store');

Route::post('/contact/message',[ContactController::class,'message'])->name('contact.message');

Route::resource('blogs', BlogController::class)
->middlewareFor(['create','store'],'auth');
// Route::resource('blogs', BlogController::class);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



