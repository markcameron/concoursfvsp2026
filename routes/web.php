<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SponsorController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::controller(ContactController::class)->group(function () {
    Route::prefix('contact')->name('contact.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('contact', 'store')->name('store');
    });
});

Route::controller(SponsorController::class)->group(function () {
    Route::prefix('sponsor')->name('sponsor.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('devenir-sponsor', 'info')->name('info');
        Route::get('contact', 'form')->name('contact');
        Route::post('contact', 'store')->name('store');
    });
});

Route::get('/finaliser-compte', function () {
    return view('admin/finalize_account/{{token}}');
})->name('finalize_account');
