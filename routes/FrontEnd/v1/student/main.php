<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'FrontEnd\v1\RegistrationStudent', 'prefix' => 'student'],function (){

    Route::get('/registration', 'ViewController@registrationStudent');

});
