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
use Illuminate\Support\Facades\DB;

class AdmAttendanceController extends Controller
{
    public function adminDashboard()
    {
        // Deklarasi variable
        $database = DB::connection('mysql');
        $today = Carbon::now()->format('Y-m-d');

        // Data untuk header
        $employee_total = User::whereIn('user_grade', [2, 3, 4])->count();
        $daily_task_total = Task::where('task_date', '=', $today)->count('task_id');
        $onTime_employee_total = $database->table('abs_in')->where('status_check_in', 'like', 'On Time')->where('abs_date', '=', $today)->count();
        $attandance_total = $database->table('abs_in')->where('abs_date', '=', $today)->count();
        if ($attandance_total > 0) {
            $percentageOntime = str_split(($onTime_employee_total / $attandance_total) * 100, 4)[0];
        } else {
            $percentageOntime = 0;
        }
        
        $attendance_logs = DB::table('absen', 'abs')
            ->select(
                'abs.abs_id',
                'abs.abs_date as date', 
                'emp.employee_full_name as emp_name', 
                'absIn.abs_time as check_in_time', 
                DB::raw("TIMEDIFF(absOut.abs_time, absIn.abs_time) as workHour"),
                DB::raw(
                    "TIMEDIFF(
                        SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(absOut.abs_time, absIn.abs_time)))),
                        SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(task_end_time, task_start_time))))
                    ) as Overtime"
                    )
                )
            ->join('emp_person as emp', 'abs.abs_emp_id', '=', 'emp.emp_id')
            ->join('absen_in as absIn', 'abs.abs_in_id', '=', 'absIn.abs_in_id')
            ->join('absen_out as absOut', 'abs.abs_out_id', '=', 'emp.abs_out_id')
            ->join('tbl_task as tsk', 'absIn.task_id', '=', 'tsk.task_id')
            ->groupBy('abs.abs_date');
        
        $data_employee = [$employee_total,$daily_task_total, $percentageOntime, $attendance_logs];

        return view('admin.dashboard', ['data' => $data_employee]);
    }

    public function attendanceDetails($absen_id){
        $attendance_details = DB::table('absen', 'abs')
            ->select(
                'dpt.dept_name as department',
                'div.division_name as division',
                'post.pos_name as position',
                'emp3.emp_full_name as leader',
                'emp4.emp_full_name as manager',
                'tsk.task_name',
                'emp5.emp_full_name as task_assign_by',
                'tsk.task_start_time',
                'tsk.task_end_time',
                'tsk.task_address',
                'tsk.task_emp_status as status',
                'absIn.abs_time as abs_in_time',
                'absIn.status_check_in',
                DB::raw('TIMEDIFF(absIn.abs_time,tsk.task_start_time) as time_diff'),
                'absIn.abs_reason as summary',
                'absOut.abs_time as abs_out_time',
                'absOut.status_check_out',
                DB::raw('TIMEDIFF(absOut.abs_time,tsk.task_end_time) as time_diff'),
                'absOut.abs_reason as summary'
                )
            ->join('emp_position as emp1', 'abs.abs_emp_id', '=', 'emp1.emp_id')
            ->join('emp_person as emp2', 'emp1.emp_id', '=', 'emp2.emp_id') 
            ->join('emp_person as emp3', 'emp1.emp_coach', '=', 'emp3.emp_id') 
            ->join('emp_person as emp4', 'emp1.emp_manager', '=', 'emp4.emp_id')
            ->join('tbl_department as dpt', 'emp1.emp_department', '=', 'dpt.dept_id')
            ->join('tbl_division as div', 'emp1.emp_division', '=', 'div.division_id')
            ->join('tbl_position as post', 'emp1.emp_post', '=', 'post.pos_id')
            ->join('abs_in as absIn', 'abs.abs_in_id', '=','absIn.abs_in_id') 
            ->join('abs_out as absOut', 'abs.abs_out_id', '=','absOut.abs_out_id')
            ->join('tbl_task as tsk', 'absIn.task_id', '=', 'tsk.task_id')
            ->join('emp_person as emp5', 'tsk.task_assign_by', '=', 'emp5.emp_id')
            ->where('abs.abs_id', '=', $absen_id)
            ->get();
        
            return view('admin.attendanceDetails', ['details' => $attendance_details]);
    }
}
