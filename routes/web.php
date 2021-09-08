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
    return view('welcome');
  // echo"kkkk";
});
Route::get('/test', function () {
   // return view('welcome');
   return view('welcome1');
});
Route::get('/test','testcontroller@index') ;
Route::post('/login','LoginController@index') ;
Route::post('/testlogin','LoginTestController@index') ;
Route::get('/main','MainPageController@index') ;
Route::get('/president','MainPageController@presidentPage') ;
Route::get('/executive','MainPageController@executivePage') ;
Route::get('/associate','MainPageController@associatePage') ;
Route::get('/dean','MainPageController@deanPage') ;
Route::get('/logout','LoginController@getLogout') ;

Route::post('pages/pinpout','AttendenceController@pinpout') ;
Route::resource('pages','AttendenceController');


Route::resource('staff','StaffController');
Route::resource('holiday','HolidayController');
Route::resource('leave','LeaveController');

Route::resource('supervisor','SupervisorController');
Route::resource('HR','HRController');
Route::resource('reason','ReasonController');

Route::resource('Exception','ExceptionController');
Route::resource('EmployeeException','EmployeeExceptionController');

Route::get('CheckPunchOutValid','AttendenceController@checkPunchOutValid');
Route::get('checkpunchinlocationvalid','AttendenceController@checkPunchInloction');



Route::get('/send/email', 'TestMailController@mail');
Route::get('/send/email1', 'TestMailController@mail1');

Route::resource('Department','DepartmentController');

Route::resource('ManagerAttendance','ManagerAttendanceReportController');
Route::resource('EmployeeAttendance','EmployeeAttendanceReportController');
Route::resource('Manager','ManagerExceptionController');

/*Route::get('DepartmentAttendance','HRController@viewMonthlyAttDprtIndex')->name('HR.Department');
Route::post('DepartmentAttendance','HRController@viewMonthlyAttDprt')->name('HR.postDepartmentAtt');

Route::get('DepartmentAttendance','HRController@viewMonthlyAttDprt');*/


Route::get('DepartmentAttendanceExcel','HRController@viewMonthlyAttDprtIndex');
Route::post('DepartmentAttendance','HRController@viewMonthlyAttDprt');
Route::get('DepartmentAttendance','HRController@viewMonthlyAttDprt');
//Route::get('test', 'TestMailController@test1');

Route::get('AddHoliday','HRController@AddCalendarView');
Route::post('addHolidayDate','HRController@AddCalendarPost');
Route::post('delete/{id}','HRController@deletepost');
Route::get('UpdattinofficeTiming','HRController@UpdattinofficeTiming');
Route::get('editview/{id}','HRController@editView');
Route::post('update','HRController@updateOfficeSatwrk');





