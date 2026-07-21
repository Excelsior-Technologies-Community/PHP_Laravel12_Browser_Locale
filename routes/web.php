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

Route::post(
    '/language/switch',
    [HomeController::class, 'ajaxChangeLanguage']
)->name('language.switch');

Route::get(
    '/locale/reset',
    [HomeController::class, 'resetLocale']
)->name('locale.reset');

Route::get(
    '/translations',
    [HomeController::class, 'translations']
);

Route::get(
    '/analytics/chart-data',
    [HomeController::class, 'getChartData']
)->name('analytics.chart-data');

Route::get(
    '/analytics/visits',
    [HomeController::class, 'getVisitHistory']
)->name('analytics.visits');
