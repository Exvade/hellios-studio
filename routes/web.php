<?php

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\Studio\CategoryController;
use App\Http\Controllers\Studio\DistributorController;
use App\Http\Controllers\Studio\ProductController;
use App\Http\Controllers\Studio\StudioDashboardController;
use App\Http\Controllers\StudioAccessController;
use App\Http\Middleware\EnsureStudioAccess;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\Route;

Route::put('/language/{locale}', [LanguageController::class, 'update'])->name('language.update');

Route::middleware(SetLocale::class)->group(function (): void {
    Route::get('/', HomeController::class)->name('home');
    Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');
    Route::get('/catalog/{product}', [CatalogController::class, 'show'])->name('catalog.show');
});

Route::middleware(SetLocale::class)->prefix('studio')->name('studio.')->group(function (): void {
    Route::get('login', [StudioAccessController::class, 'create'])->name('login');
    Route::post('login', [StudioAccessController::class, 'store'])->name('login.store');

    Route::middleware(EnsureStudioAccess::class)->group(function (): void {
        Route::get('/', StudioDashboardController::class)->name('index');
        Route::resource('categories', CategoryController::class)->except('show');
        Route::resource('distributors', DistributorController::class)->except('show');
        Route::resource('products', ProductController::class)->except('show');
        Route::delete('logout', [StudioAccessController::class, 'destroy'])->name('logout');
    });
});
