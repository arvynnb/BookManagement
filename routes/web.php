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
    Auth::logout(); 
    // dd(Auth::user());
    return view('index');
});
//SEARCH
Route::get('/admin/search', 'SearchController@filter_search');
Route::get('/admin/student/search', 'SearchController@search_student');
Route::get('/student/search', 'SearchController@filter_search');
//REGISTER
Route::get('register','RegisterController@index');
Route::post('register','RegisterController@register');
//AUTH LOGIN
Route::post('/login', 'AuthController@authlogin');
//LOGOUT
Route::get('/logout','AuthController@logout');

//ADMIN
Route::group(['middleware' => 'login'], function () {

    Route::get('/admin', 'AdminController@index');

    Route::get('/admin/createbook', 'AdminController@create');
    Route::post('/admin/createbook', 'AdminController@store');

    Route::get('/admin/{book}/edit', 'AdminController@edit');
    Route::put('/admin/{book}/edit', 'AdminController@update');
    Route::delete('/admin/{book}/delete','AdminController@delete');

    Route::get('/admin/{book}/view-book', 'AdminController@viewbook');
    Route::get('/admin/view-request', 'AdminController@viewrequest');
    Route::get('/admin/{book}/view-request-student/{student}', 'AdminController@viewrequest_student');
    Route::post('/admin/view-request/status', 'AdminController@approve_decline');

    Route::get('/admin/student-list','adminStudentListController@student_list');
    Route::get('/admin/{student}/student-details','adminStudentListController@student_details');
    Route::put('/admin/{student}/student-details','adminStudentListController@student_update');

    Route::get('/admin/course','adminCourseController@course_list');
    route::post('/admin/add-course','adminCourseController@add_course');
    route::get('/admin/{course}/course-details','adminCourseController@course_details');
    Route::put('/admin/{course}/course-details','adminCourseController@course_update');
    Route::delete('/admin/course/{course}/delete','adminCourseController@course_delete');
    
    Route::get('/admin/export','ExportController@books_export');
    Route::get('/admin/student-list/export','ExportController@students_export');
});

//STUDENT
Route::group(['middleware' => 'student_login'], function () {
    Route::get('/student','StudentController@index');
    Route::get('/student/{book}/single-view', 'StudentController@singleview');
    Route::post('/student', 'StudentController@borrow');
    Route::get('/student/record', 'StudentController@record');
    Route::post('/student/record/book_returned', 'StudentController@book_returned');
    Route::get('/student/{book}/request-details/{borrow}', 'StudentController@request_details');
});

