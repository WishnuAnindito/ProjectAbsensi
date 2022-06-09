<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use App\Models\AbsenIn;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Task;
use App\Models\User;
// use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdmAttendanceController extends Controller
{
    

    public function adminDashboard()
    {
        // Deklarasi Model
        $absen = new Absen();
        $absenIn = new AbsenIn();
        $task = new Task();

        $today = $absen->getDate('today');
        // $emp_id = Auth::user()->emp_id;

        // Data untuk header
        $employee_total = User::whereIn('user_grade', [2, 3, 4])->count();
        // $daily_task_total = $task->dailyTask('total', $today, $emp_id);
        $daily_task_total = $task->dailyTask('total', $today, 1);
        $onTime_employee_total = $absenIn->onTimeEmployeeDaily('total', $today);
        $attandance_total = $absenIn->attendanceToday('total', $today);
        if ($attandance_total > 0) {
            $percentageOntime = str_split(($onTime_employee_total / $attandance_total) * 100, 4)[0];
        } else {
            $percentageOntime = 0;
        }

        $attendance_logs = $absen->logs();
        $data_employee = [$employee_total,$daily_task_total, $percentageOntime, $attendance_logs];

        return view('admin.dashboard', ['data' => $data_employee]);
        // return redirect("login")->withSuccess('You are not allowed to access');
        // return "Gagal Login";
    }

    public function attendanceDetailsTest(){
        return view('admin.attendancedetails');
    }

    public function attendanceDetails($absen_id){
        $attendance = new Task();
        $attendance_details = $attendance->details($absen_id);
        return view('admin.attendancedetails', ['details' => $attendance_details]);
    }

    public function weeklyAttendance()
    {
        $attendance = new Absen();
        $start_of_Attendance = $attendance->getDate('monday');
        $end_of_Attendance = $attendance->getDate('sunday');
        $report_data = $attendance->weeklyAttendanceLogs($start_of_Attendance,$end_of_Attendance);
        return view('admin.report', ['report' => $report_data]);
    }
}
