<?php

use App\Http\Controllers\ContactFormController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->middleware('throttle:5,1');
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::get('/admin/search-contacts', [AdminController::class, 'searchContacts'])->name('admin.searchContacts');
Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');

Route::post('/contact', [ContactFormController::class, 'store'])->middleware('throttle:10,1')->name('contact.store');
