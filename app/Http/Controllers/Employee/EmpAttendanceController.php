<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Store\CheckInRequest as StoreCheckInRequest;
use App\Models\Absen;
use App\Models\AbsenIn;
use App\Models\Employee;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class EmpAttendanceController extends Controller
{
    public function employeeDashboardtest(){
        // dd(Auth::user());
        return view('employee.dashboard');
    }

    public function employeeDashboard(){
        $employee = new Employee();
        $task = new Task();
        $date = new Absen();

        $today = $date->getDate('today');
        $emp_id = Auth::user()->emp_id;
        
        $emp_details = $employee->details($emp_id);

        $task_employee = $task->dailyTask('data',$today,$emp_id);
        return view('employee.dashboard', [
            'details' => $emp_details,
            'task' => $task_employee
        ]);
    }

    public function checkIn(StoreCheckInRequest $request, $task_id,$emp_id){
        $request->validated();
        $checkIn = new AbsenIn();
        $checkInSuccess = $checkIn->insertData($request, $task_id,$emp_id);
        if($checkInSuccess){
            return redirect()->back()->with('Success', 'CheckIn has been Successed!!!');
        }else{
            return redirect()->back()->with('Failed', 'CheckIn has been Failed!!!');
        }
    }

    // public function checkOut(){

    // }
}
