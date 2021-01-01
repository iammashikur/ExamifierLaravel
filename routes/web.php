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

// Cache Cleaner
Route::get('/clear', function () {
    return $exitCode = Artisan::call('config:cache');
});


 Route::get('/migrate', function () {
     return $exitCode = Artisan::call('migrate:fresh');
 });



 Route::get('/seed', function () {
     return $exitCode = Artisan::call('db:seed');
 });



Route::get('/', 'StudentController@login')->name('home');
Route::get('/', 'StudentController@login')->name('home');
Route::get('/forgot-password', 'StudentController@forgot')->name('forgot');
Route::post('/forgot-reset', 'StudentController@reset')->name('forgot.reset');




Route::get('backend/', 'AdminController@login');

Auth::routes();


// Students
Route::group(['prefix'=>'student' , 'middleware'=>'auth'], function () {
    Route::get('dashboard', 'StudentController@index')->name('student.dashboard');
    Route::get('exams', 'StudentController@exams')->name('student.exams');
    Route::get('exam/{id}', 'StudentController@exam');
    Route::post('exam_complete', 'StudentController@exam_complete')->name('student.exam_complete');
    Route::get('results', 'StudentController@results')->name('student.results');
    Route::get('result/{id}', 'StudentController@result')->name('student.result');
    Route::get('notice', 'StudentController@notice')->name('student.notice');
    Route::get('exam/{id}/leaderboard', 'StudentController@leaderboard')->name('student.leaderboard');
});

// Examiner
Route::group(['prefix'=>'examiner' , 'middleware'=>'is_examiner'], function () {
    Route::get('dashboard', 'ExaminerController@index')->name('examiner.dashboard');
    // Make An Exam
    Route::get('questions', 'ExaminerController@questions')->name('examiner.questions');
    Route::post('exam', 'ExaminerController@exam_store')->name('examiner.exam_store');
    // All Exams
    Route::get('exams', 'ExaminerController@exams')->name('examiner.exams');
    // Update An Exam
    Route::get('exam/edit/{id}', 'ExaminerController@exam_edit')->name('examiner.exam_edit');
    Route::post('exam/update', 'ExaminerController@exam_update')->name('examiner.exam_update');
    // Show Results
    Route::get('results', 'ExaminerController@results')->name('examiner.results');

    Route::get('result/{id}', 'ExaminerController@result_list')->name('examiner.result_list');

    Route::get('result/student/{student_id}/exam/{exam_id}', 'ExaminerController@student_result')->name('examiner.student_result');
    // Notice
    Route::get('notice', 'ExaminerController@notice')->name('examiner.notice_all');
    Route::post('notice', 'ExaminerController@notice_insert')->name('examiner.notice');
    Route::get('notice_delete/{id}', 'ExaminerController@notice_delete')->name('examiner.notice_delete');
});


Route::get('/pdf/{exam_id}', 'ResultController@pdf')->name('pdf');


// Students
Route::group(['prefix'=>'admin' , 'middleware'=>'auth'], function () {
    Route::get('dashboard', 'AdminController@index')->name('admin.dashboard');
    Route::get('user/delete/{id}', 'AdminController@delete')->name('admin.delete');
    Route::get('user/add', 'AdminController@add_user')->name('admin.add_user');
    Route::post('user/store', 'AdminController@store_user')->name('admin.store_user');

    Route::get('user/add_examiner', 'AdminController@add_examiner')->name('admin.add_examiner');
    Route::post('user/store_examiner', 'AdminController@store_examiner')->name('admin.store_examiner');


    Route::get('user/edit/{id}', 'AdminController@edit')->name('admin.edit');
    Route::post('user/update', 'AdminController@update')->name('admin.update_user');

    Route::get('search', 'AdminController@search')->name('search');
});
