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

Route::get('/', 'Auth\LoginController@showLoginForm');

Auth::routes(['register' => false]);

Route::middleware('password')->group(function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    Route::post('dates/disabled', 'DateController@disabled');

    Route::get('leave-requests/pending', 'LeaveRequestsController@pending')->name('leave-requests.pending');
    Route::get('leave-requests/recommended', 'LeaveRequestsController@recommended')->name('leave-requests.recommended');
    Route::post('leave-requests/recommend-all', 'LeaveRequestsController@recommendAll')->name('recommend.all');
    Route::get('leave-requests/approved', 'LeaveRequestsController@approved')->name('leave-requests.approved');
    Route::post('leave-requests/approve-all', 'LeaveRequestsController@approveAll')->name('approve.all');
    Route::PUT('leave-requests/destroy', 'LeaveRequestsController@destroy')->name('leave-requests.destroy');
    Route::PUT('leave-requests/update/{id}', 'LeaveRequestsController@update')->name('leave-requests.update');

    Route::get('inplace-requests', 'InplaceRequestsController@index')->name('inplace.index');
    Route::PUT('inplace-requests/{inplace}', 'InplaceRequestsController@update')->name('inplace.update');
    Route::post('applications/get-dates', 'LeaveApplicationController@getDates')->name('applications.dates');
    Route::resource('applications', 'LeaveApplicationController');

    Route::resource('employees', 'EmployeeController');
    Route::resource('roles', 'RoleController');
    Route::resource('departments', 'DepartmentController');
    Route::resource('leave-types', 'LeaveTypeController');
    Route::resource('holidays', 'HolidayController');
    Route::resource('employment-types', 'EmploymentController');
});

Route::get('settings', 'SettingController@edit')->name('settings.edit');
Route::put('settings', 'SettingController@update')->name('settings.update');
