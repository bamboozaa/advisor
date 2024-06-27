<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes([
    'reset' => false,
    'verify' => false,
    'register' => false,
]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::group(['middleware' => 'auth'], function() {
    Route::resource('advisors', App\Http\Controllers\AdvisorController::class);
    Route::resource('students', App\Http\Controllers\StudentController::class);
    Route::resource('academics', App\Http\Controllers\AcademicController::class);
    Route::resource('qualifications', App\Http\Controllers\QualificationController::class);
    Route::resource('departments', App\Http\Controllers\DepartmentController::class);
    Route::resource('faculties', App\Http\Controllers\FacultyController::class);
    Route::resource('majors', App\Http\Controllers\MajorController::class);
    Route::get('students/{id}/show_dep', [App\Http\Controllers\StudentController::class, 'show_dep'])->name('students.show_dep');

    Route::get('/report-advisor', [App\Http\Controllers\ReportController::class, 'index'])->name('reports.index');
    Route::get('/report-advisor/{advisor}', [App\Http\Controllers\ReportController::class, 'show'])->name('reports.show');
    Route::get('/report-advisor/{advisor}/edit', [App\Http\Controllers\ReportController::class, 'edit'])->name('reports.edit');
    Route::post('/report-advisor/{advisor}', [App\Http\Controllers\ReportController::class, 'update'])->name('reports.update');


});
