<?php

use App\Http\Controllers\PrijsAfstandController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home')->name('home');
Route::view('/contact', 'pages.contact')->name('contact');
Route::view('/prijzen', 'pages.prijzen')->name('prijzen');
Route::get('/prijzen/afstand', PrijsAfstandController::class)->name('prijzen.afstand');
