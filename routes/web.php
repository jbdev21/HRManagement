<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;

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
});

Route::group(['middleware' => 'web'], function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
    Route::resource('user', UserController::class)->middleware('admin');
    Route::resource('category', CategoryController::class)->middleware("admin");

    //Employee resource controller  
    Route::resource('employees', EmployeeController::class)->middleware('admin');
    //route save addDocument to EmployeeController
    Route::post('employees/addDocument/{id}', [EmployeeController::class, 'addDocument'])->name('employees.addDocument');
    //route deleteDocument to EmployeeController
    Route::delete('employees/deleteDocument/{id}', [EmployeeController::class, 'deleteDocument'])->name('employees.deleteDocument');

    //Department resource controller
    Route::resource('departments', DepartmentController::class);
});
