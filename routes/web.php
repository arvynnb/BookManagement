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
    return view('index');
});
//AUTH
Route::post('/login', 'AuthController@authlogin');
//ADMIN

// Route::post('/admin', 'LoginController@Admin');
// Route::post('/admin', 'AdminController@login');

Route::get('/admin', 'AdminController@index')->middleware('login');

Route::get('/admin/createbook', 'AdminController@create')->middleware('login');
Route::post('/admin/createbook', 'AdminController@store')->middleware('login');

Route::get('/admin/{book}/edit', 'AdminController@edit')->middleware('login');
Route::put('/admin/{book}/edit', 'AdminController@update')->middleware('login');

Route::delete('/admin/{book}/delete','AdminController@delete')->middleware('login');

Route::get('/admin/{book}/view-book', 'AdminController@viewbook')->middleware('login');
Route::get('/admin/view-request', 'AdminController@viewrequest')->middleware('login');
Route::get('/admin/{book}/view-request-student', 'AdminController@viewrequest_student')->middleware('login');

// Route::post('/admin/view-request/status', 'AdminController@approve');

// Route::post('/admin/view-request/status', 'AdminController@approve');
Route::post('/admin/view-request/status', 'AdminController@approve_decline')->middleware('login');


Route::get('/','AdminController@logout')->middleware('logout');

//STUDENTS
Route::get('/student','StudentController@index')->middleware('student_login');
Route::get('/student/{book}/single-view', 'StudentController@singleview')->middleware('student_login');
Route::post('/student', 'StudentController@borrow')->middleware('student_login');
Route::get('/student/record', 'StudentController@record')->middleware('student_login');
Route::post('/student/record/book_returned', 'StudentController@book_returned')->middleware('student_login');
Route::get('/student/{book}/request-details', 'StudentController@request_details')->middleware('student_login');


