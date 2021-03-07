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

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('attendance/ScheduledToWork', 'ScheduledToWorkController@index')->name('attendance.ScheduledToWork');

Route::get('attendance/workScheduled', 'WorkScheduledController@index')->name('attendance.workScheduled');
Route::post('attendance/workScheduled', 'WorkScheduledController@scheduledCreate')->name('attendance.scheduledCreate');
Route::get('attendance/workInquiry/{employeeNumber}', 'WorkScheduledController@inquiry')->name('attendance.workInquiry');
Route::get('attendance/workInquiryEdit/{id}', 'WorkScheduledController@edit')->name('attendance.workEdit');
Route::post('attendance/workInquiryEdit{id}', 'WorkScheduledController@scheduledUpdate')->name('attendance.scheduledUpdate');
Route::get('attendance/workAuthInquiry', 'WorkScheduledController@inquiryAuth')->name('attendance.workInquiryAuth');


Route::group(['prefix' => 'attendance', 'middleware' => 'auth'], function() {
    Route::get('index', 'AttendanceSystemController@index')->name('arrendance.index');
    Route::get('create', 'AttendanceSystemController@create')->name('attendance.create');
    Route::post('begin', 'AttendanceSystemController@beginTimeStamp')->name('attendance.begin');
    Route::post('finish', 'AttendanceSystemController@finishTimeStamp')->name('attendance.finish');
});
