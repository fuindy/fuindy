<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'FrontEnd', 'prefix' => 'cust'],function (){
    Route::get('/vw-cust', 'CustomerController@index');
});

Route::group(['namespace' => 'FrontEnd', 'prefix' => 'student'],function (){
    Route::get('/', 'CustomerController@index');
});

Route::group(['namespace' => 'FrontEnd', 'prefix' => 'teacher'],function (){
    Route::get('/', 'CustomerController@index');
});