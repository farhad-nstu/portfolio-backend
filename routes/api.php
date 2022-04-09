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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('login', 'API\AuthController@login');
Route::post('register', 'API\AuthController@register');
Route::post('forgot-password', 'API\UserController@forgot_password');
Route::post('reset-password', 'API\UserController@reset_password');
Route::get('user', 'API\UserController@get_authenticate_user')->middleware('auth:api');
Route::get('projects', 'API\CommonController@get_projects');
Route::get('services', 'API\CommonController@get_services');
Route::get('members', 'API\CommonController@get_members');
// Route::post('contact', 'API\CommonController@contact');
Route::get('about', 'API\CommonController@about');
Route::get('skills', 'API\CommonController@skill');
Route::get('educations', 'API\CommonController@education');
Route::get('resume', 'API\CommonController@resume');

/// New Portfolio
Route::get('menus', 'API\CommonController@fetch_menu');
Route::get('menus/{id}', 'API\CommonController@fetch_menu_childs');
Route::get('works', 'API\CommonController@fetch_works');
Route::get('testimonials', 'API\CommonController@fetch_testimonials');
Route::post('contact', 'API\CommonController@contact');