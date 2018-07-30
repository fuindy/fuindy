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

require(base_path($front_end . 'dashboard/main.php'));
require(base_path($front_end . 'school/main.php'));
require(base_path($front_end . 'student/main.php'));
require(base_path($front_end . 'teacher/main.php'));
require(base_path($front_end . 'registrationStudent/main.php'));
require(base_path($front_end . 'visitor/main.php'));

require(base_path($back_end . 'registrationStudent.php'));
require(base_path($back_end . 'school.php'));
require(base_path($back_end . 'student.php'));
require(base_path($back_end . 'teacher.php'));
require(base_path($back_end . 'visitor.php'));

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('resources/countries', 'HomeController@testing');
//Route::get('resources/countries', function (){
//    $test = [
//        [
//            "text" => "Home",
//            "website-link" => "http://easyautocomplete.com/"
//        ],
//        [
//            "text" => "Guide",
//            "website-link" => "http://easyautocomplete.com/guide"
//        ],
//        [
//            "text" => "Themes",
//            "website-link" => "http://easyautocomplete.com/themes"
//        ]
//    ];
//
//    return $test;
//});

Route::group(['prefix' => 'testing'], function () {

    Route::get('/', function () {
        return view('pages.display.dashboard');
    });

});
