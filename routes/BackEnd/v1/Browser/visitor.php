<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1/b'], function () {

    Route::group(['namespace' => 'BackEnd\Browser\v1\Visitor', 'prefix' => 'visitor'], function () {

        Route::post('add', 'LoginController@registrationVisitor');

    });

});
