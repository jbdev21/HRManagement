<?php

use App\Http\Controllers\ApplicantController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\WorkExperienceController;

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

Auth::routes();

Route::get('/', function () {
    return view('auth.login');
})->middleware("guest");

Route::group(['middleware' => ['web', 'auth']], function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
    Route::resource('user', UserController::class)->middleware('admin');
    Route::resource('category', CategoryController::class)->middleware("admin");

    //Employee resource controller  
    Route::get('employees/{id}/leave-card', [EmployeeController::class, 'leaveCard'])->name("employees.leave-card");
    Route::resource('employees', EmployeeController::class);
    //route save addDocument to EmployeeController
    Route::post('employees/addDocument/{id}', [EmployeeController::class, 'addDocument'])->name('employees.addDocument');
    //route deleteDocument to EmployeeController
    Route::delete('employees/deleteDocument/{id}', [EmployeeController::class, 'deleteDocument'])->name('employees.deleteDocument');
    
    
    Route::get('report', [ReportController::class, 'accession'])->name("report.employee.accession");
    Route::resource('applicant', ApplicantController::class);
    //route save addDocument to ApplicantController
    Route::post('applicant/addDocument/{id}', [ApplicantController::class, 'addDocument'])->name('applicant.addDocument');
    //route deleteDocument to ApplicantController
    Route::delete('applicant/deleteDocument/{id}', [ApplicantController::class, 'deleteDocument'])->name('applicant.deleteDocument');

    //Department resource controller
    Route::resource('departments', DepartmentController::class);

    //WorkExperience resource controller
    Route::resource('work_experiences', WorkExperienceController::class);

    //EmployeeLeave resource controller
    Route::resource('leave', LeaveController::class);
});
