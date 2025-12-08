<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\HomepageController;

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

Route::get('/', HomepageController::class)->name('homepage');

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

Route::controller(PageController::class)->group(function () {
    Route::name('pages.')->group(function () {
        Route::get('comite', 'committee')->name('committee');
    });
});

Route::get('/finaliser-compte', function () {
    return view('admin/finalize_account/{{token}}');
})->name('finalize_account');
