<?php

use App\Http\Controllers;
use App\Http\Controllers\Admin\AdmAttendanceController;

use App\Http\Controllers\Employee\AttendanceController;
use App\Http\Controllers\Employee\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Mail\MailController;
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

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/send-email', [MailController::class, 'sendEmail']);

// Admin Controller
Route::controller(AdmAttendanceController::class)->group(function(){
    // Dashboard
    Route::get('/dashboardadmin', 'adminDashboard')->name('dashboard-admin');

    // All List
    Route::get('/employeelist','employeeList')->name('employee-list');
    Route::get('/ontimelist','onTimeEmployee')->name('on-time');
    Route::get('/latetimelist', 'lateTimeEmployee')->name('late-time');
    Route::get('/leaveearlylist', 'leaveEarlyEmployee')->name('leave-early');
    Route::get('/leaveontimelist', 'leaveOnTimeEmployee')->name('leave-on-time');
    Route::get('/overtimelist', 'overTimeEmployee')->name('over-time');
    
    // Report 
    Route::get('/weeklyreport', 'attendanceWeeklyReport')->name('weekly-report');
});

// Page for Guest Only
Route::middleware('guest')->group(function(){
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'customLogin'])->name('login');
});

// Page for Users who have registered or successfully logged in
Route::middleware('auth')->group(function(){
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});



Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance');
Route::post('/checkinattendance', [AttendanceController::class, 'checkInStore'])->name('check-in');
Route::post('/checkoutattendance', [AttendanceController::class, 'checkOutStore'])->name('check-out');
