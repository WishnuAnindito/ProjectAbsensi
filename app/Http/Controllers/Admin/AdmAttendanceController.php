<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AbsenIn;
use App\Models\Employee;
use App\Models\Task;
use App\Models\User;
// use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdmAttendanceController extends Controller
{
    public function adminDashboard()
    {
        // Deklarasi variable
        $database = DB::connection('mysql');
        $today = Carbon::now()->format('Y-m-d');

        // Data untuk header
        // $employee_total = $database->table('tbl_users')->where('user_grade', '<', '3')->count();
        $employee_total = User::whereIn('user_grade', [2, 3, 4])->count();
        // $daily_task_total = $database->table('tbl_task')->where('task_date', '=', $today)->count();
        $daily_task_total = Task::where('task_date', '=', $today)->count('task_id');
        $onTime_employee_total = $database->table('abs_in')->where('status_check_in', 'like', 'On Time')->where('abs_date', '=', $today)->count();
        $attandance_total = $database->table('abs_in')->where('abs_date', '=', $today)->count();
        if ($attandance_total > 0) {
            $percentageOntime = str_split(($onTime_employee_total / $attandance_total) * 100, 4)[0];
        } else {
            $percentageOntime = 0;
        }
        
        // Data body halaman dashboard
        $attendance_technician_data = $database->table('emp_position', 'pos')
            ->select('person.emp_full_name', 'tpos.pos_name', 'tsk.task_id', 'abs.status_check_in')
            ->join('emp_person as person', 'pos.emp_id', '=', 'person.emp_id')
            ->join('tbl_position as tpos', 'pos.emp_post', '=', 'tpos.pos_id')
            ->join('tbl_task as tsk', 'pos.emp_id', '=', 'tsk.task_assign_to')
            ->join('abs_in as abs', 'pos.emp_id', '=', 'abs.abs_emp_id')
            ->where('tsk.task_date', '=', $today)
            ->where('abs.abs_date', '=', $today)
            ->whereIn('pos.emp_grade', [2, 3, 4])
            ->get();

        $data_employee = [$employee_total,$daily_task_total, $percentageOntime, $attendance_technician_data];

        return view('admin.dashboard', ['data' => $data_employee]);
    }

    public function employeeList()
    {
        $employees = DB::table('emp_position', 'pos')
            ->select('person.emp_id', 'person.emp_full_name', 'dpt.dept_name', 'div.division_name', 'tpos.pos_name', 'person2.emp_full_name as coach', 'person3.emp_full_name as manager')
            ->join('emp_person as person', 'pos.emp_id', '=', 'person.emp_id')
            ->join('emp_person as person2', 'pos.emp_coach', '=', 'person2.emp_id')
            ->join('emp_person as person3', 'pos.emp_manager', '=', 'person3.emp_id')
            ->join('tbl_department as dpt', 'pos.emp_department', '=', 'dpt.dept_id')
            ->join('tbl_division as div', 'pos.emp_division', '=', 'div.division_id')
            ->join('tbl_position as tpos', 'pos.emp_post', '=', 'tpos.pos_id')
            ->whereIn('pos.emp_grade', ['I', 'II', 'III'])
            ->get();

        return view('admin.employee', ['employees' => $employees]);
    }

    public function onTimeEmployee()
    {
        // $today = Carbon::now()->format('Y-m-d');
        $today = Carbon::now();
        $on_time_employee = DB::table('abs_in', 'abs')
            ->select('abs.abs_date', 'person.emp_full_name', 'tsk.task_name', 'abs.abs_time', 'tsk.task_start_time', 'tsk.task_id')
            // , '(tsk.task_start_time - abs.abs_time) as `Durasi Kehadiran Awal`')
            ->join('emp_person as person', 'abs.abs_emp_id', '=', 'person.emp_id')
            ->join('tbl_task as tsk', 'abs.abs_emp_id', '=', 'tsk.task_assign_to')
            // ->where('abs.abs_date', '=', $today)
            // ->where('abs.abs_date', '=', Carbon::today())
            ->where('abs.status_check_in', 'like', 'On Time')
            ->get();
        return view('admin.ontime', ['ontime' => $on_time_employee]);
    }

    public function lateTimeEmployee()
    {
        $today = Carbon::now()->format('Y-m-d');
        $late_time_employee = DB::table('abs_in', 'abs')
            ->select('abs.abs_date', 'person.emp_full_name', 'tsk.task_name', 'abs.abs_time', 'tsk.task_start_time')
            // 'TIMEDIFF(abs.abs_time,tsk.task_start_time) as Telat')
            ->join('emp_person as person', 'abs.abs_emp_id', '=', 'person.emp_id')
            ->join('tbl_task as tsk', 'abs.abs_emp_id', '=', 'tsk.task_assign_to')
            ->whereDate('abs.abs_date', $today)
            ->where('abs.status_check_in', 'like', 'Late')
            ->get();
        return view('admin.latetime', ['latetime' => $late_time_employee]);
    }

    public function leaveEarlyEmployee()
    {
        $today = Carbon::now()->format('Y-m-d');
        $leave_early_employee = DB::table('abs_out', 'abs')
            ->select('abs.abs_date', 'person.emp_full_name', 'tsk.task_name', 'abs.abs_time', 'tsk.task_end_time')
            // , '(tsk.task_end_time - abs.abs_time) as `Durasi Kepulangan Awal`')
            ->join('emp_person as person', 'abs.abs_emp_id', '=', 'person.emp_id')
            ->join('tbl_task as tsk', 'abs.abs_emp_id', '=', 'tsk.task_assign_to')
            ->where('abs.abs_date', '=', $today)
            ->where('abs.status_check_out', 'like', 'Leave Early')
            ->get();
        return view('admin.leaveearly', ['leaveearly' => $leave_early_employee]);
    }

    public function leaveOnTimeEmployee()
    {
        $today = Carbon::now()->format('Y-m-d');
        $leave_on_time_employee = DB::table('abs_out', 'abs')
            ->select('abs.abs_date', 'person.emp_full_name', 'tsk.task_name', 'abs.abs_time', 'tsk.task_end_time')
            // , '(abs.abs_time - tsk.task_end_time) as `Durasi Kepulangan Akhir`')
            ->join('emp_person as person', 'abs.abs_emp_id', '=', 'person.emp_id')
            ->join('tbl_task as tsk', 'abs.abs_emp_id', '=', 'tsk.task_assign_to')
            ->where('abs.abs_date', '=', $today)
            ->where('abs.status_check_out', 'like', 'Leave Early')
            ->get();
        return view('admin.leaveontime', ['leaveontime' => $leave_on_time_employee]);
    }


    public function overTimeEmployee()
    {
        $ind = CarbonImmutable::now()->locale('id');
        $start_of_Attendance = $ind->startOfWeek(Carbon::MONDAY);
        $end_of_Attendance = $ind->endOfWeek(Carbon::SUNDAY);

        $over_time_employee = DB::table('absen', 'abs')
            ->select('person.emp_full_name', 'post.pos_name')
            // , 'SEC_TO_TIME(SUM(TIME_TO_SEC(absOut.abs_time - absIn.abs_time))) as `Durasi Lembur`')
            ->join('abs_in as absIn', 'abs.abs_in_id', '=', 'absIn.abs_in_id')
            ->join('abs_out as absOut', 'abs.abs_out_id', '=', 'absIn.abs_out_id')
            ->join('emp_person as person', 'abs.abs_emp_id', '=', 'person.emp_id')
            ->join('emp_position as pos', 'abs.abs_emp_id', '=', 'pos.emp_id')
            ->join('tbl_position as abs post', 'pos.emp_pos', '=', 'pos.pos_id')
            ->whereBetween('abs.abs_date', [$start_of_Attendance, $end_of_Attendance], 'and')
            ->groupBy('abs.abs_id')
            ->having('`Durasi Lembur', '>', 40)
            ->get();
        return view('admin.overtime', ['overtime' => $over_time_employee]);
    }

    public function weeklyAttendance()
    {
        $ind = CarbonImmutable::now()->locale('id');
        $start_of_Attendance = $ind->startOfWeek(Carbon::MONDAY);
        $end_of_Attendance = $ind->endOfWeek(Carbon::SUNDAY);

        $report_data = DB::table('absen', 'abs')
            ->select('abs.abs_date', 'person.emp_full_name', 'tsk.task_name', 'absIn.status_check_in', 'absOut.status_check_out')
            ->join('emp_person as person', 'abs.abs_emp_id', '=', 'person.emp_id')
            ->join('abs_in as absIn', 'abs.abs_in_id', '=', 'absIn.abs_in_id')
            ->join('abs_out as absOut', 'abs.abs_out_id', '=', 'absOut.abs_out_id')
            ->join('tbl_task as tsk', 'abs.abs_emp_id', '=', 'tsk.task_assign_to')
            ->whereBetween('abs.abs_date', [$start_of_Attendance, $end_of_Attendance], 'and')
            ->get();

        return view('admin.report', ['report' => $report_data]);
    }


    
}
