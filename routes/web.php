<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

$front_end = 'routes/FrontEnd/v1/';
$back_end = 'routes/BackEnd/v1/Browser/';

require(base_path($front_end . 'Customer/student/main.php'));
require(base_path($front_end . 'School/main.php'));

require(base_path($back_end . 'registrationStudent.php'));
require(base_path($back_end . 'school.php'));
require(base_path($back_end . 'student.php'));
require(base_path($back_end . 'teacher.php'));
require(base_path($back_end . 'visitor.php'));

Route::get('/', function () {
    return view('welcome');
});

//Route::group(['prefix' => 'test'], function () {
//
//    Route::get('/', 'FrontEnd\v1\RegistrationStudent\ViewController@registrationStudent');
//
//});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
