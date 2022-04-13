<?php

use App\Http\Controllers;
use App\Http\Controllers\Admin\AdmAttendanceController;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\Employee\AttendanceController;
use App\Http\Controllers\Employee\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

// Auth::routes();

// Route::get('/home', [Controllers\HomeController::class, 'index'])->name('home');

Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'customLogin'])->middleware('guest')->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/dashboardadmin', [AdmAttendanceController::class, 'adminDashboard'])->name('dashboard-admin');

Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance');
Route::post('/checkinattendance', [AttendanceController::class, 'checkInStore'])->name('check-in');
Route::post('/checkoutattendance', [AttendanceController::class, 'checkOutStore'])->name('check-out');

Route::get('/attendanceadmin', [AdmAttendanceController::class, 'dailyAttendance'])->name('attendance-admin');

Route::get('/testHome', function(){
    return view('homepage');
});


Route::get('/cekdb', function(){
    $local_database = DB::connection();
    $live_local_database = $local_database->table('emp_person')->get();
    echo count($live_local_database);
});

Route::get('/header', [HeaderController::class, 'create']);

// Route::get('/today', [AdminController::class,'dailyAttendance']);
Route::get('/today', function(){
    echo Carbon::now()->format('Y-m-d');
});

Route::get('/get-procedure', function(){
    $procedure = DB::select('call teknisiDD()'); //->get('dept_name');
    foreach ($procedure as $dpt){
        $dept_name = $dpt->dept_name;
        echo $dept_name ."<br>";
    }
});