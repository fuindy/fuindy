<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1/b'], function () {

    Route::group(['namespace' => 'BackEnd\Browser\v1\School', 'prefix' => 'school'], function () {

        Route::group(['prefix' => 'add'], function () {

            Route::post('school', 'AddSchoolController@addSchool');
            Route::post('department', 'AddSchoolController@addDepartment');
            Route::post('photo', 'AddSchoolController@addPhoto');
            Route::post('gallery', 'AddSchoolController@addGallery');

        });

//        Route::group(['middleware' => 'auth.school'], function () {

            Route::group(['prefix' => 'class'], function (){

                Route::get('list', 'SchoolController@getListClass');
                Route::get('component', 'SchoolController@getComponentClass');
                Route::post('add', 'SchoolController@addClass');

            });

            Route::group(['prefix' => 'registration'], function () {

                Route::post('date', 'RegistrationStudentController@registrationDate');
                Route::post('confirm', 'RegistrationStudentController@confirmRegistration');
                Route::post('accepted', 'RegistrationStudentController@acceptedStudent');

            });

            Route::group(['prefix' => 'question.js/registration'], function () {

                Route::post('add', 'QuestionController@addQuestion');
                Route::get('list', 'QuestionController@getQuestionRegistration');
                Route::post('upload', 'QuestionController@uploadQuestionRegistration');
                Route::get('component', 'QuestionController@getComponent');
                Route::get('detail', 'QuestionController@getQuestionRegistrationDetail');
                Route::post('update-status', 'QuestionController@questionRegistrationStatus');

            });

//        });

    });

});
