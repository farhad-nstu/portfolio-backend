<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
}); 
// ['register'=>false]
Auth::routes();

// Route::get('locale/{locale}',function($locale){
//     Session::put('locale',$locale);
//     return redirect()->back(); 
// });


Route::get('/home', 'HomeController@index')->name('home');

//User Registration
Route::get('/user-registration','UserRegistrationController@showRegistrationForm')->name('user-registration')->middleware('auth');

Route::post('/user-registration','UserRegistrationController@userSave')->name('user-save')->middleware('auth');

Route::get('/user-list','UserRegistrationController@userList')->name('user-list')->middleware('auth');

Route::get('/status-active/{userId}','UserRegistrationController@statusActive')->name('status-active')->middleware('auth');

Route::get('/status-deactive/{userId}','UserRegistrationController@statusDeactive')->name('status-deactive')->middleware('auth');

 


//Change Languages
Route::get('lang/change', 'HomeController@change')->name('changeLang');

Route::get('/home/application-settings', 'HomeController@showSettings')->name('showSettings');

Route::get('/home/view-profile', 'HomeController@viewProfile')->name('viewProfile');

Route::post('/home/view-profile', 'HomeController@updateProfile')->name('profileUpdate');

//Change Password
Route::get('/home/password-change-view', 'HomeController@passwordChangeView')->name('passwordChangeView');

Route::post('/home/password-change-view', 'HomeController@passwordUpdate')->name('passwordUpdate');

Route::post('/home/application-settings', 'HomeController@settingsUpdate')->name('settings-update');

//// Facebbok login ///
Route::get('/login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('/login/facebook/callback', 'Auth\LoginController@handleProviderCallback');


///// new added /////
Route::group(['prefix' => 'admin','middleware'=>'auth', 'namespace'=>'Admin'], function () {
    Route::resource('project', 'ProjectController');
    Route::get('project-delete/{id}', 'ProjectController@delete_project');
    Route::resource('service', 'ServiceController');
    Route::resource('member', 'MemberController');
    Route::resource('client', 'ClientController');
    Route::resource('about', 'AboutController');
    Route::resource('skill', 'SkillController');
    Route::get('skill-delete/{id}', 'SkillController@skill_delete');
    Route::resource('attribute', 'AttributeController');
    Route::resource('award', 'AwardController');
    Route::resource('education', 'EducationController');

    Route::get('resume', 'ResumeController@index')->name('resume');
    Route::get('insert-resume', 'ResumeController@insert_resume')->name('insert.resume');
    Route::post('resume-store', 'ResumeController@resume_store')->name('resume.store');
    Route::get('resume-edit', 'ResumeController@resume_edit')->name('resume.edit');
    Route::get('file-download/{id}', 'ResumeController@file_download')->name('file.download');

    // new portfolio 
    Route::resource('menus', 'MenuController');
    Route::resource('portfolioMenus', 'PortfolioMenuController');
    Route::resource('portfolioMenuChilds', 'PortfolioMenuChildController');
    Route::resource('works', 'WorkController');
    Route::resource('testimonials', 'TestimonialController');
});

