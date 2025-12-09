<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscribersController;
use App\Http\Controllers\ThemeController;
use Illuminate\Support\Facades\Route;

Route::controller(ThemeController::class)->name('theme.')->group(function () { 
    Route::get('/','index')->name('index');
    Route::get('/category/{id}','category')->name('category');
    Route::get('/contact','contact')->name('contact');
});

Route::post('/subscriber',[SubscribersController::class,'store'])->name('subscriber.store');

Route::post('/contact/message',[ContactController::class,'message'])->name('contact.message');

Route::middleware('auth')->get('/my-blog',[BlogController::class,'myBlogs'])->name('blogs.my-blogs');


Route::post('/comments/store',[CommentController::class,'store'])->name('comments.store');

Route::resource('blogs', BlogController::class)->except('index')
->middlewareFor(['create','store'],'auth');
require __DIR__.'/auth.php';


