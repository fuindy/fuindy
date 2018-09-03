<?php

use Illuminate\Support\Facades\Route;

Route::prefix('school')->namespace('FrontEnd\v1\School')->group(function (){
    Route::get('/vw-add', 'ViewController@addSchool')->name('school.view.add');
    Route::get('/vw-cust', 'ViewController@viewCustomerSchool')->name('school.view.customer');
    Route::get('/vw-vst', 'ViewController@viewVisitorSchool')->name('school.view.visitor');
});
