<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CitiesController;

/*
Nick Adams
CSCD 378

Basically thre is a sqlite database file that this laravel framework is configured to utilize. 
There is a model, view, and a controller for City which goes into the cities database. The controller calls toView is called 
when the user navigates to the route url/cities. The toView function returns an array of cities from the database which the view then 
uses to display to the user. 
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('cities', [CitiesController::class, 'toView']);
