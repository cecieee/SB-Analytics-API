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




Route::post('/register', 'RegisterController@register');
Route::post('/login', 'LoginController@login');
Route::get('/logout', 'LoginController@logout')->middleware('auth:sanctum');

Route::post('/users', 'LoginController@users');

Route::middleware('auth:sanctum')->get('users', "LoginController@users") ;;

Route::post('/upload', 'SheetController@resolve');
Route::get('/members', 'SheetController@index');
Route::get('/members/{id}', 'SheetController@search_id');
Route::get('/members/{id}', 'SheetController@search_name');
Route::get('/members/{id}', 'SheetController@show_category');
Route::post('/email', 'SheetController@email');
