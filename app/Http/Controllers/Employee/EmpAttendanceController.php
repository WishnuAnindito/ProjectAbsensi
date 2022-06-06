<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use App\Models\AbsenIn;
use App\Models\AbsenOut;
use App\Models\Employee;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmpAttendanceController extends Controller
{
    public function employeeDashboardtest(){
        return view('employee.dashboard');
    }

    public function employeeDashboard(){
        $emp_id = Auth::user()->emp_id;
        $employee = new Employee();
        $emp_details = $employee->details($emp_id);
        return view('employee.dashboard', [
            'details' => $emp_details
        ]);
    }

    public function onTimeHistory(){

    }
}
