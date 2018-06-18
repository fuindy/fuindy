<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'FrontEnd', 'prefix' => 'school'],function (){
    Route::get('/vw-add', 'SchoolController@viewAddSchool')->name('school.view.add');
    Route::get('/vw-cust', 'SchoolController@viewCustomerSchool')->name('school.view.customer');
    Route::get('/vw-vst', 'SchoolController@viewVisitorSchool')->name('school.view.visitor');
});
