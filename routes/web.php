<?php

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
Auth::routes(['register'=> false]);
Route::get('/','HomeController@index');
Route::get('/admin/login','Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/admin/login','Auth\AdminLoginController@login');
Route::post('/admin/logout','Auth\AdminLoginController@logout')->name('admin.logout');

Route::middleware('auth')->group( function () {
    Route::get('/home', 'HomeController@index')->name('home');
});
Route::prefix('/admin')->name('admin.')->middleware('auth:admin')->group(function(){
    Route::get('/dashboard','HomeController@adminIndex')->name('home');
    Route::resource('user', 'UserController');
    Route::resource('admin', 'AdminController');
    Route::resource('classroom', 'ClassroomController');
    Route::resource('subject', 'SubjectController');
    Route::resource('school', 'SchoolController');
    Route::resource('schedule', 'ScheduleController');
    Route::resource('grade', 'GradeController');
    Route::resource('notice', 'NoticeController');
});

