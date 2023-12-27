<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {  
		Route::prefix('item')->name('item.')->group(function () {  
				Route::post('/store', [ItemController::class, 'store'])->name('store');
				Route::post('/destroy', [ItemController::class, 'destroy'])->name('destroy');
				Route::post('/archive', [ItemController::class, 'archive'])->name('archive');
				Route::post('/status', [ItemController::class, 'status'])->name('status');
				Route::post('/update', [ItemController::class, 'update'])->name('update');
				Route::post('/export', [ItemController::class, 'export'])->name('export');
		});
});