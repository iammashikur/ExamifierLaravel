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
Route::get('/clear', function() {

    return $exitCode = Artisan::call('config:cache');

 });


 Route::get('/migrate', function() {

    return $exitCode = Artisan::call('migrate:fresh');

 });



 Route::get('/seed', function() {

    return $exitCode = Artisan::call('db:seed');

 });



Route::get('/', 'StudentController@login')->name('home');


Route::get('backend/', 'AdminController@login');

Auth::routes();


// Students
Route::group(['prefix'=>'student' , 'middleware'=>'auth'], function()
{

    Route::get('dashboard', 'StudentController@index')->name('student.dashboard');



    Route::get('exams', 'StudentController@exams')->name('student.exams');

    Route::get('exam/{id}', 'StudentController@exam');
    Route::post('exam_complete', 'StudentController@exam_complete')->name('student.exam_complete');

    Route::get('results', 'StudentController@results')->name('student.results');
    Route::get('result/{id}', 'StudentController@result')->name('student.result');
    Route::get('notice', 'StudentController@notice')->name('student.notice');



});

// Examiner
Route::group(['prefix'=>'examiner' , 'middleware'=>'is_examiner'], function()
{
    Route::get('dashboard', 'ExaminerController@index')->name('examiner.dashboard');
    Route::get('questions', 'ExaminerController@questions')->name('examiner.questions');
    Route::post('exam', 'ExaminerController@exam_store')->name('examiner.exam_store');

});

