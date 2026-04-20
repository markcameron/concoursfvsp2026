<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\DiaporamaController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\QrRedirectController;
use App\Http\Controllers\SponsorCommunesController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\SponsorListController;
use App\Http\Controllers\TugOfWarController;
use Illuminate\Support\Facades\Route;

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
    Route::prefix('hebergement')->name('housing.')->group(function () {
        Route::get('', 'housing')->name('index');
        Route::post('', 'storeHousing')->name('store');
    });
});

// Route::controller(ContactController::class)->prefix('hebergement')->name('housing.')->group(function () {
//     Route::get('', 'housing')->name('index');
//     Route::post('', 'storeHousing')->name('store');
// });

// Route::controller(TugOfWarController::class)->group(function () {
//     Route::prefix('tir-au-tuyau')->name('tir-au-tuyau.')->group(function () {
//         Route::get('', 'index')->name('index');
//         Route::post('', 'store')->name('store');
//     });
// });

Route::controller(SponsorController::class)->group(function () {
    Route::prefix('sponsor')->name('sponsor.')->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('devenir-sponsor', 'info')->name('info');
        Route::get('contact', 'form')->name('contact');
        Route::post('contact', 'store')->name('store');
    });
});

Route::controller(SponsorListController::class)->group(function () {
    Route::prefix('sponsors')->name('sponsors.')->group(function () {
        Route::get('', 'index')->name('index');
    });
});

Route::controller(SponsorCommunesController::class)->group(function () {
    Route::prefix('communes')->name('sponsors.')->group(function () {
        Route::get('', 'index')->name('communes');
    });
});

Route::controller(PageController::class)->group(function () {
    Route::name('pages.')->group(function () {
        Route::get('comite', 'committee')->name('committee');
        Route::get('benevoles', 'volunteers')->name('volunteers');
        Route::get('affichage-caserne', 'station')->name('station');
        Route::get('donations', 'donations')->name('donations');
        Route::get('livret', 'livret')->name('livret');
        Route::get('livret/lire', 'livretViewer')->name('livret.viewer');
        Route::get('programme', 'programme')->name('programme');
        Route::get('plan-de-fete', 'map')->name('map');
        Route::get('cortege', 'procession')->name('procession');
    });
});

Route::get('/finaliser-compte', function () {
    return view('admin/finalize_account/{{token}}');
})->name('finalize_account');

Route::get('diaporama', [DiaporamaController::class, 'index'])->name('diaporama');
Route::get('diaporama/soumettre', [DiaporamaController::class, 'submit'])->name('diaporama.submit');
Route::post('diaporama/soumettre', [DiaporamaController::class, 'store'])->name('diaporama.store');
Route::post('diaporama/{submission}/vote', [DiaporamaController::class, 'vote'])->name('diaporama.vote');
Route::post('diaporama/{submission}/report', [DiaporamaController::class, 'report'])->name('diaporama.report');

Route::get('qr/{slug}', QrRedirectController::class)->name('qr.redirect')
    ->where('slug', '.+');
