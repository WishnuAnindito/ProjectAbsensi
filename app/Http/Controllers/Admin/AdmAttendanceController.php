<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdmAttendanceController extends Controller
{
    public function adminDashboard()
    {
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
            ->whereIn('pos.emp_grade', ['I', 'II', 'III'])
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

    public function employeeList()
    {
        $employees = DB::table('emp_position', 'pos')
            ->select('person.emp_id', 'person.emp_full_name', 'dpt.dept_name', 'div.division_name', 'tpos.pos_name', 'person2.emp_full_name as coach', 'person3.emp_full_name as manager')
            ->join('emp_person as person', 'pos.emp_id', '=', 'person.emp_id')
            ->join('emp_person as person2', 'pos.emp_coach', '=', 'person2.emp_id')
            ->join('emp_person as person3', 'pos.emp_manager', '=', 'person3.emp_id')
            ->join('tbl_department as dpt', 'pos.emp_department', '=', 'dpt.dept_id')
            ->join('tbl_division as div', 'pos.emp_division', '=', 'div.division_id')
            ->join('tbl_position as tpos', 'pos.emp_position', '=', 'tpos.pos_id')
            ->whereIn('pos.emp_grade', ['I', 'II', 'III'])
            ->get();
        return view('admin.employee', ['employees' => $employees]);
    }

    public function onTimeEmployee()
    {
        $today = Carbon::now()->format('Y-m-d');
        $on_time_employee = DB::table('abs_in', 'abs')
            ->select('abs.abs_date', 'person.emp_full_name', 'tsk.task_name', 'abs.abs_time', 'tsk.task_start_time', '(tsk.task_start_time - abs.abs_time) as `Durasi Kehadiran Awal`')
            ->join('emp_person as person', 'abs.abs_emp_id', '=', 'person.emp_id')
            ->join('tbl_task as tsk', 'abs.abs_emp_id', '=', 'tsk.task_assign_to')
            ->where('abs.abs_date', '=', $today)
            ->where('abs.status_check_in', 'like', 'On Time');
        return view('admin.ontime', ['ontime' => $on_time_employee]);
    }

    public function lateTimeEmployee()
    {
        $today = Carbon::now()->format('Y-m-d');
        $late_time_employee = DB::table('abs_in', 'abs')
            ->select('abs.abs_date', 'person.emp_full_name', 'tsk.task_name', 'abs.abs_time', 'tsk.task_start_time', '(abs.abs_time - tsk.task_start_time) as `Durasi Keterlambatan`')
            ->join('emp_person as person', 'abs.abs_emp_id', '=', 'person.emp_id')
            ->join('tbl_task as tsk', 'abs.abs_emp_id', '=', 'tsk.task_assign_to')
            ->where('abs.abs_date', '=', $today)
            ->where('abs.status_check_in', 'like', 'Late');
        return view('admin.latetime', ['latetime' => $late_time_employee]);
    }


    public function leaveEarlyEmployee()
    {
        $today = Carbon::now()->format('Y-m-d');
        $leave_early_employee = DB::table('abs_out', 'abs')
            ->select('abs.abs_date', 'person.emp_full_name', 'tsk.task_name', 'abs.abs_time', 'tsk.task_end_time', '(tsk.task_end_time - abs.abs_time) as `Durasi Kepulangan Awal`')
            ->join('emp_person as person', 'abs.abs_emp_id', '=', 'person.emp_id')
            ->join('tbl_task as tsk', 'abs.abs_emp_id', '=', 'tsk.task_assign_to')
            ->where('abs.abs_date', '=', $today)
            ->where('abs.status_check_out', 'like', 'Leave Early');
        return view('admin.leaveearly', ['leaveearly' => $leave_early_employee]);
    }

    public function leaveOnTimeEmployee()
    {
        $today = Carbon::now()->format('Y-m-d');
        $leave_on_time_employee = DB::table('abs_out', 'abs')
            ->select('abs.abs_date', 'person.emp_full_name', 'tsk.task_name', 'abs.abs_time', 'tsk.task_end_time', '(abs.abs_time - tsk.task_end_time) as `Durasi Kepulangan Akhir`')
            ->join('emp_person as person', 'abs.abs_emp_id', '=', 'person.emp_id')
            ->join('tbl_task as tsk', 'abs.abs_emp_id', '=', 'tsk.task_assign_to')
            ->where('abs.abs_date', '=', $today)
            ->where('abs.status_check_out', 'like', 'Leave Early');
        return view('admin.leaveontime', ['leaveOnTime' => $leave_on_time_employee]);
    }


    public function overTimeEmployee()
    {
        $ind = CarbonImmutable::now()->locale('id');
        $start_of_Attendance = $ind->startOfWeek(Carbon::MONDAY);
        $end_of_Attendance = $ind->endOfWeek(Carbon::SUNDAY);

        $over_time_employee = DB::table('absen', 'abs')
            ->select('person.emp_full_name', 'post.pos_name', 'SEC_TO_TIME(SUM(TIME_TO_SEC(absOut.abs_time - absIn.abs_time))) as `Durasi Lembur`')
            ->join('abs_in as absIn', 'abs.abs_in_id', '=', 'absIn.abs_in_id')
            ->join('abs_out as absOut', 'abs.abs_out_id', '=', 'absIn.abs_out_id')
            ->join('emp_person as person', 'abs.abs_emp_id', '=', 'person.emp_id')
            ->join('emp_position as pos', 'abs.abs_emp_id', '=', 'pos.emp_id')
            ->join('tbl_position as abs post', 'pos.emp_position', '=', 'pos.pos_id')
            ->whereBetween('abs.abs_date', [$start_of_Attendance, $end_of_Attendance], 'and')
            ->groupBy('abs.abs_id')
            ->having('`Durasi Lembur', '>', 40);
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
            ->whereBetween('abs.abs_date', [$start_of_Attendance, $end_of_Attendance], 'and');

        return view('admin.attendanceReport', ['report' => $report_data]);
    }

    public function attendanceWeeklyReport()
    {
        // $data = [
        //     'title' => 'Welcome to ItSolutionStuff.com',
        //     'date' => date('m/d/Y')
        // ];

        // $pdf = PDF::loadView('myPDF', $data);

        // return $pdf->download('itsolutionstuff.pdf');
        return view('admin.report');
    }
}
