<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;


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

Route::get('/', function () {
    return view('index');
});

Route::get('/admin',[AdminController::class,'index'])->name('admin');;

Route::get('/signup', [AdminController::class,'view_signup'])->name('signup');
Route::post('/signup', [AdminController::class, 'register'])->name('signup.post');

Route::get('/login', [AdminController::class,'view_login'])->name('login');
Route::post('/login', [AdminController::class,'login'])->name('login.post');

Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

//route resource department
Route::get('depart/{id}/delete',[DepartmentController::class,'destroy']);
Route::resource('depart',DepartmentController::class);

//route resource employee
Route::get('employees/{id}/delete',[EmployeeController::class,'destroy']);
Route::resource('employees',EmployeeController::class);

// Attendance Sheet
Route::get('attendance/sheet', [AttendanceController::class, 'showAttendanceSheet'])->name('attendance.sheet');
Route::get('attendance/report', [AttendanceController::class, 'showSheetReport'])->name('attendance.report');
Route::get('attendance/log', [AttendanceController::class, 'showAttendanceLog'])->name('attendance.log');
Route::post('attendance', [AttendanceController::class, 'storeAttendance'])->name('attendance.store');
Route::get('attendance/{id}/edit', [AttendanceController::class, 'edit'])->name('attendance.edit');
// Route::post('attendance/{id}', [AttendanceController::class, 'update'])->name('attendance.update');
Route::put('attendance/{id}', [AttendanceController::class, 'update'])->name('attendance.update');










