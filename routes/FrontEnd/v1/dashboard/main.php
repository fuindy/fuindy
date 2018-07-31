<?php

/*
 |--------------------------------------------------------------------------
 | Dashboard Route
 |--------------------------------------------------------------------------
 */
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'dashboard'], function () {
    Route::get('/', 'Dashboard\ViewController@index')->name('dashboard');
});