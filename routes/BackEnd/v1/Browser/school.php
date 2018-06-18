<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1/b'], function () {

    Route::group(['namespace' => 'BackEnd\Browser\v1\School', 'prefix' => 'school'], function () {

        Route::post('add-school', 'AddSchoolController@addSchool');
        Route::post('add-department', 'AddSchoolController@addDepartment');
        Route::post('add-photo', 'AddSchoolController@addPhoto');
        Route::post('add-gallery', 'AddSchoolController@addGallery');

        Route::post('registered-date', 'SchoolController@registeredDate');

    });

});
