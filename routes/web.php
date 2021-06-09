<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalenderController;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('teachers', App\Http\Controllers\TeacherController::class);

Route::resource('courses', App\Http\Controllers\CourseController::class);

Route::resource('students', App\Http\Controllers\StudentController::class);

Route::resource('times', App\Http\Controllers\TimeController::class);


Route::get('home/calender', [App\Http\Controllers\CalenderController::class, 'index']);
Route::post('home/calenderAjax', [App\Http\Controllers\CalenderController::class, 'ajax']);