<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ItemController;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () { return Inertia::render('Welcome'); })->name('landing');
Route::get('/businesses', function () { return Inertia::render('Projects'); })->name('businesses');
Route::get('/projects', function () { return Inertia::render('Projects'); })->name('projects');
Route::get('/tasks', function () { return Inertia::render('Tasks'); })->name('tasks');
Route::get('/finances', function () { return Inertia::render('Projects'); })->name('finances');
Route::get('/identity', function () { return Inertia::render('Projects'); })->name('identity');
Route::get('/life', function () { return Inertia::render('Projects'); })->name('life');
Route::get('/terms-of-service', function () { return Inertia::render('TermsOfService'); })->name('terms');
Route::get('/privacy-policy', function () { return Inertia::render('PrivacyPolicy'); })->name('policy');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', [ItemController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified', 'admin'])->group(function () {
		Route::get('/admin', [AdminController::class, 'index'])->name('admin');
});