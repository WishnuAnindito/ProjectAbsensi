<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdmAttendanceController extends Controller
{
    public function adminDashboard(){
        $database = DB::connection('mysql');
        $today = Carbon::now()->format('Y-m-d');

        // Jumlah karyawan teknisi
        $employee_total = $database->table('tbl_users')->where('user_grade', '<', '3')->count();

        // Jumlah task hari ini
        // $daily_task_total = $database->table('tbl_task')->where('task_date', '=', $today)->count();
        
        // Jumlah attendance yang ontime
        $onTime_employee_total = $database->table('abs_in')
                        ->where('status_check_in', 'like', 'On Time')
                        ->where('abs_date', '=', $today)
                        ->count();
        
        // Data Technisian Attendance
        $attendance_technician_data = $database->table('emp_position', 'pos')
                        ->select('person.emp_full_name', 'tpos.pos_name', 'img.emp_image_file', 'tsk.task_id', 'abs.abs_status_in')
                        ->join('emp_person as person', 'pos.emp_id', '=', 'person.emp_id')
                        ->join('tbl_position as tpos', 'pos.emp_position', '=', 'tpos.pos_id')
                        ->join('emp_images as img', 'pos.emp_id', '=', 'img.emp_id')
                        ->join('tbl_task as tsk', 'pos.emp_id', '=', 'tsk.task_assign_to')
                        ->join('absen_in as abs', 'pos.emp_id', '=', 'abs.abs_emp_id')
                        ->where('img.emp_image_name', 'like', 'Photo Profile')
                        ->where('tsk.task_date', '=', $today)
                        ->where('abs.abs_date', '=', $today)
                        ->whereIn('pos.emp_grade', ['I','II','III'])
                        ->get();

        // Jumlah attendance hari ini
        $attandance_total = $database->table('abs_in')->count('abs_in_id'); 
        
        // Persentase kehadiran
        if ($attandance_total > 0) {
            $percentageOntime = str_split(($onTime_employee_total / $attandance_total) * 100, 4)[0];
        } else {
            $percentageOntime = 0;
        }

        $data_employee = [$employee_total, $percentageOntime, $onTime_employee_total, $attendance_technician_data];

        return view('admin.dashboard', ['data' => $data_employee]);
    }

    public function employeeList(){
        $employees = DB::table('emp_position', 'pos')
                    ->select('person.emp_id', 'person.emp_full_name', 'dpt.dept_name', 'div.division_name', 'tpos.pos_name', 'person2.emp_full_name as coach', 'person3.emp_full_name as manager')
                    ->join('emp_person as person', 'pos.emp_id', '=', 'person.emp_id')
                    ->join('emp_person as person2', 'pos.emp_coach', '=', 'person2.emp_id')
                    ->join('emp_person as person3', 'pos.emp_manager', '=', 'person3.emp_id')
                    ->join('tbl_department as dpt', 'pos.emp_department', '=', 'dpt.dept_id')
                    ->join('tbl_division as div', 'pos.emp_division','=', 'div.division_id')
                    ->join('tbl_position as tpos', 'pos.emp_position', '=', 'tpos.pos_id')
                    ->whereIn('pos.emp_grade', ['I','II','III'])
                    ->get();
        return view('admin.employee', ['employees' => $employees]);
    }

    public function dailyAttendance(){
        $today = Carbon::now()->format('Y-m-d');
        $data = DB::connection('mysql')->table('absen')
                    ->select('call admDailyCheckIn(?)', array($today))->get();
        return view('admin.attendance', ['attendance', $data]);
    }

    public function weeklyAttendance(){
        $ind = CarbonImmutable::now()->locale('id');
        $start_of_Attendance = $ind->startOfWeek(Carbon::MONDAY);
        $end_of_Attendance = $ind->endOfWeek(Carbon::SUNDAY);
        
        $report_data = DB::connection('mysql')->table('absen')
                    ->select('call admWeeklyAttendance(?,?)', array($start_of_Attendance,$end_of_Attendance));
        
        return view('admin.attendanceReport', ['report' => $report_data]);
    }

    public function lateTimeEmployee(){
        // $database = DB::connection('mysql');
        // $lateTime_employee = $database->select('SELECT * FROM abs_in WHERE status_check_in LIKE `Late`');
        // return view('admin.latetime', ['late' => $lateTime_employee]);
        return view('admin.latetime');
    }

    public function onTimeEmployee(){
        // $database = DB::connection('mysql');
        // $onTime_employee = $database->select('SELECT * FROM abs_in WHERE status_check_in LIKE `On Time` ');
        // return view('admin.ontime', ['onTime' => $onTime_employee]);
        return view('admin.ontime');
    }

    public function overTimeEmployee(){
        return view('admin.overtime');
    }

    public function leaveEarlyEmployee(){
        return view('admin.leaveearly');
    }
    
    public function leaveOnTimeEmployee(){
        return view('admin.leaveontime');
    }

    public function attendanceWeeklyReport(){
        return view('admin.report');
    }
}
