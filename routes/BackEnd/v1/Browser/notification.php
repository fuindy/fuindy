<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix', 'v1/b'], function () {
    Route::group(['prefix', 'notification'], function () {
    });
});