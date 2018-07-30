<?php
/**
 * Created by PhpStorm.
 * User: kevinpurwono
 * Date: 22/11/17
 * Time: 3:33 PM
 */

/*
 |--------------------------------------------------------------------------
 | Registration student Route
 |--------------------------------------------------------------------------
 */


use Illuminate\Support\Facades\Route;

Route::prefix('registration/student')->namespace('FrontEnd\v1\RegistrationStudent')->group(function () {

//    Route::middleware('permission:view attendance')->group(function () {

        Route::get('/', 'ViewController@index')->name('registration.index');
//    });

});
