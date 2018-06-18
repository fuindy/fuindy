<?php
/**
 * Created by PhpStorm.
 * Users: yuswa
 * Date: 04/05/2018
 * Time: 8:32 AM
 */

/* v1/a = version 1 Android API */
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1/a'], function () {

    Route::group(['namespace' => 'BackEnd\API\v1\Auth', 'prefix' => 'auth'], function () {

        Route::post('login', 'LoginController@login');
        Route::post('refresh', 'LoginController@refresh');

        Route::group(['middleware' => 'auth:api'], function () {

            Route::post('login/success', 'LoginController@loginSuccessful');
            Route::post('logout', 'LoginController@logout');
        });

    });

});