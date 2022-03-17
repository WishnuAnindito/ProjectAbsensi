<?php

use App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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
    return view('employee.attendance', ['today' => Carbon::now()->toDateString()]);
});

Auth::routes();

Route::get('/home', [Controllers\HomeController::class, 'index'])->name('home');

Route::get('/attendance', [Controllers\Admin\AttendanceController::class, 'index'])->name('attendance');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/testHome', function(){
    return view('test');
});