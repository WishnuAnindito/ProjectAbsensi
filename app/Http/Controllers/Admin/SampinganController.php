<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SampinganController extends Controller
{
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
