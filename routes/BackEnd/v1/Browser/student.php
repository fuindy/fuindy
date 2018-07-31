<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1/b'], function () {

    Route::group(['namespace' => 'BackEnd\Browser\v1\Student', 'prefix' => 'student'], function () {

        Route::group(['middleware', 'auth.student'], function () {

            Route::get('registered', 'RegistrationStudentController@getDataRegistration');

            Route::group(['prefix' => 'question.js'], function (){

                Route::get('list', 'QuestionStudentTestController@getListQuestion');
                Route::get('detail', 'QuestionStudentTestController@getQuestionStudent');
                Route::post('answer', 'QuestionStudentTestController@checkAnswerStudent');

            });

        });

    });

});
