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
Route::post('/admin/login','Auth\AdminLoginController@login')->name('admin.login');
Route::post('/admin/logout','Auth\AdminLoginController@logout')->name('admin.logout');

Route::middleware('auth')->group( function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/moodle', 'HomeController@moodle')->name('moodle');
    Route::get('/calendar', 'HomeController@calendar')->name('calendar');
    Route::get('/getNotices', 'NoticeController@getNotices');
});

Route::prefix('/admin')->name('admin.')->middleware('auth:admin')->group(function(){
    Route::get('/','HomeController@adminIndex')->name('home');
    Route::get('/logs','HomeController@adminLogs')->name('logs');
    Route::resource('user', 'UserController');
    Route::resource('admin', 'AdminController');
    Route::resource('classroom', 'ClassroomController');
    Route::resource('subject', 'SubjectController');
    Route::resource('school', 'SchoolController');
    Route::resource('schedule', 'ScheduleController');
    Route::resource('grade', 'GradeController');
    Route::resource('notice', 'NoticeController');
    Route::resource('role', 'RoleController');
    Route::post('/markAsRead', 'HomeController@markAsRead');
    Route::get('/getSchedules', 'ScheduleController@getSchedules');
});

