<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get(
    '/',
    [HomeController::class, 'index']
);

Route::get(
    '/language/{locale}',
    [HomeController::class, 'changeLanguage']
)->name('language.change');

Route::get(
    '/locale/reset',
    [HomeController::class, 'resetLocale']
)->name('locale.reset');

Route::get(
    '/translations',
    [HomeController::class, 'translations']
);