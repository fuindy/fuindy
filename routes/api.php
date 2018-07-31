<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$backAndPath = 'routes/BackEnd/v1/';
$APIPath = 'API/';
/*
|--------------------------------------------------------------------------
| Init Android API routes
|--------------------------------------------------------------------------
*/
require(base_path($backAndPath . $APIPath . 'auth.php'));
require(base_path($backAndPath . $APIPath . 'school.php'));
require(base_path($backAndPath . $APIPath . 'student.php'));
require(base_path($backAndPath . $APIPath . 'teacher.php'));