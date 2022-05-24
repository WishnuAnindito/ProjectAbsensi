<?php

use App\Http\Controllers;
use App\Http\Controllers\Admin\AdmAttendanceController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Employee\AttendanceController;
use App\Http\Controllers\Employee\DashboardController;
use App\Http\Controllers\Employee\EmpAttendanceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Leader\LeaderController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Mail\MailController;
use App\Models\Division;
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
Route::get('/attendancehistory', [EmpAttendanceController::class, 'historyPage'])->name('historyPage');
Route::get('/send-email', [MailController::class, 'sendEmail']);

// Admin Controller
Route::controller(AdmAttendanceController::class)->group(function () {
    // Dashboard
    Route::get('/admin/dashboard', 'adminDashboard')->name('dashboard-admin');

    // All List
    Route::get('/admin/employeelist', 'employeeList')->name('employee-list-admin');
    Route::get('/admin/ontimelist', 'onTimeEmployee')->name('on-time-admin');
    Route::get('/admin/latetimelist', 'lateTimeEmployee')->name('late-time-admin');
    Route::get('/admin/leaveearlylist', 'leaveEarlyEmployee')->name('leave-early-admin');
    Route::get('/admin/leaveontimelist', 'leaveOnTimeEmployee')->name('leave-on-time-admin');
    Route::get('/admin/overtimelist', 'overTimeEmployee')->name('over-time-admin');

    // Report 
    Route::get('/admin/weeklyreport', 'weeklyAttendance')->name('weekly-report-admin');

});

Route::controller(EmployeeController::class)->group(function () {
    Route::get('/admin/addemployee', 'index')->name('add-new-employee-page');
});

Route::controller(LeaderController::class)->group(function () {
    Route::get('/leader/dashboard', 'leaderDashboard')->name('dashboard-leader');

    Route::get('/leader/employeelist', 'employeeList')->name('employee-list-leader');
    Route::get('/leader/ontimelist', 'onTimeEmployee')->name('on-time-leader');
    Route::get('/leader/latetimelist', 'lateTimeEmployee')->name('late-time-leader');
    Route::get('/leader/leaveearlylist', 'leaveEarlyEmployee')->name('leave-early-leader');
    Route::get('/leader/leaveontimelist', 'leaveOnTimeEmployee')->name('leave-on-time-leader');
    Route::get('/leader/overtimelist', 'overTimeEmployee')->name('over-time-leader');

    Route::get('/leader/weeklyreport', 'attendanceWeeklyReport')->name('weekly-report-leader');

    Route::get('/leader/create-task', 'createTask')->name('create-task');
});

// Page for Guest Only
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'customLogin'])->name('login');
});

// Page for Users who have registered or successfully logged in
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});


// Gk Kepake
Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance');
Route::post('/checkinattendance', [AttendanceController::class, 'checkInStore'])->name('check-in');
Route::post('/checkoutattendance', [AttendanceController::class, 'checkOutStore'])->name('check-out');
Route::get('/seeder', function(){
    $division = Division::all()->pluck('division_id')->toArray();
    dd($division);
});