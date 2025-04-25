<?php

use App\Http\Controllers\ContactFormController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login']);
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::get('/admin/search-contacts', [AdminController::class, 'searchContacts'])->name('admin.searchContacts');

Route::get('/', function () {
    return view('welcome');
});
Route::post('/contact', [ContactFormController::class, 'store'])->name('contact.store');
