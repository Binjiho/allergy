<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// main
Route::controller(\App\Http\Controllers\Eng\Main\MainController::class)->group(function () {
    Route::get('/', 'main')->name('main');
    Route::post('data', 'data')->name('main.data');
});

Route::controller(\App\Http\Controllers\Eng\About\AboutController::class)->prefix('about')->group(function () {
    Route::get('welcome', 'welcome')->name('welcome');
    Route::get('history', 'history')->name('history');
    Route::get('journal', 'journal')->name('journal');
    Route::get('meeting', 'meeting')->name('meeting');
    Route::get('society', 'society')->name('society');
    Route::get('past', 'past')->name('past');
    Route::get('contact', 'contact')->name('contact');
});

Route::controller(\App\Http\Controllers\Eng\Organization\OrganizationController::class)->prefix('organization')->group(function () {
    Route::get('committee', 'committee')->name('committee');
    Route::get('branch', 'branch')->name('branch');
    Route::get('working', 'working')->name('working');
});

Route::controller(\App\Http\Controllers\Eng\Publication\PublicationController::class)->prefix('publication')->group(function () {
    Route::get('aair', 'aair')->name('aair');
    Route::get('aard', 'aard')->name('aard');
    Route::get('textbook', 'textbook')->name('textbook');
});

require __DIR__ . '/common.php';