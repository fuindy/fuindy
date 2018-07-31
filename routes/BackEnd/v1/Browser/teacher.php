<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1/b'], function () {

    Route::group(['namespace' => 'BackEnd\Browser\v1\Teacher', 'prefix' => 'teacher'], function () {

        Route::group(['middleware' => 'auth.teacher'], function () {

            Route::group(['prefix' => 'question.js/student'], function () {

                Route::post('add', 'QuestionController@addQuestion');
                Route::get('list', 'QuestionController@getQuestionStudent');
                Route::post('upload', 'QuestionController@uploadQuestionStudent');
                Route::get('component', 'QuestionController@getComponent');
                Route::get('detail', 'QuestionController@getQuestionStudentDetail');
                Route::post('update-status', 'QuestionController@questionStudentStatus');

            });

        });

    });

});
