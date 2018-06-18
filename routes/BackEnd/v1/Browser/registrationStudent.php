<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1/b'], function () {

    Route::group(['namespace' => 'BackEnd\Browser\v1\Student', 'prefix' => 'registration'], function () {

        Route::post('dt-school', 'RegistrationStudentController@getSchool');
        Route::post('registered', 'RegistrationStudentController@registrationStudent');

    });

});