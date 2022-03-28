<?php

use App\Http\Controllers;
use App\Http\Controllers\Check\LoginController;
use App\Http\Controllers\PenarikanBarang\HeaderController;
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

Route::get('/', function () {
    return view('employee.attendance', ['today' => Carbon::today()->toDateString(), 'now' => Carbon::now()->toTimeString()]);
    // return DB::table('emp_person')->where('emp_id', 8)->first();
});

// Auth::routes();

// Route::get('/home', [Controllers\HomeController::class, 'index'])->name('home');

Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'customLogin'])->middleware('guest')->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/attendance', [Controllers\Admin\AttendanceController::class, 'index'])->name('attendance');

Route::get('/testHome', function(){
    return view('test');
});


Route::get('/cekdb', function(){
    $local_database = DB::connection();
    $live_local_database = $local_database->table('emp_person')->get();
    echo count($live_local_database);
});

Route::get('/header', [HeaderController::class, 'create']);