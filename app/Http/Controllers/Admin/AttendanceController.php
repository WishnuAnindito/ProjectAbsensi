<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AbsenIn;
use App\Models\Employee;
use App\Models\Task;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function attendanceToday()
    {
        $today = Carbon::now()->toDateString();
        $employee_total = Employee::all('emp_id')->count();
        $task_total = Task::where('task_date', '=', $today)->count();
        $absen_in_total = AbsenIn::where('abs_date', '=', $today)->count();
        $absen_on_time = AbsenIn::where('abs_date', '=', $today)->where('status_check_in', 'like', 'On Time')->count();
        
        if ($absen_in_total == 0) {         
            $percentage_on_time = 0;
        } else {
            $percentage_on_time = ($absen_on_time * 100) / $absen_in_total;
        }

        /* Catching Data  : 
            Absen Date
            Employee Full name
            Task Name
            Check In Time
            Check In Status
        */

        $abse_in_data = DB::table('abs_in', 'abs')
            ->select('abs.abs_date', 'emp.emp_full_name', 'tsk.task_name', 'abs.abs_time', 'abs.status_check_in')
            ->where('abs.status_check_in', 'like', 'On Time')
            ->join('tbl_task as tsk', 'abs.task_id', '=', 'tsk.task_id')
            ->join('emp_person as emp', 'abs.abs_emp_id', '=', 'emp.emp_id')
            ->orderBy('abs.abs_date', 'desc')
            ->get();

        return view('admin.dashboard', [
            'emp_total' => $employee_total,
            'tsk_total' => $task_total,
            'abs_in_total' => $absen_in_total,
            'percentage' => $percentage_on_time,
            'abs_data' => $abse_in_data
        ]);
    }

    public function attendanceOnTime()
    {
        $absen_on_time = DB::table('abs_in', 'abs')
            ->select('abs.abs_date', 'emp.emp_full_name', 'tsk.task_name', 'tsk.task_start_time', 'abs.abs_time', DB::RAW('TIMEDIFF(tsk.task_start_time,abs.abs_time) as waktu_lebih'))
            ->where('abs.status_check_in', 'like', 'On Time')
            ->join('tbl_task as tsk', 'abs.task_id', '=', 'tsk.task_id')
            ->join('emp_person as emp', 'abs.abs_emp_id', '=', 'emp.emp_id')
            ->orderBy('abs.abs_date', 'desc')
            ->get();

        return view('admin.ontime', [
            'absen' => $absen_on_time
        ]);
    }

    public function attendanceLate()
    {
        $absen_late = DB::table('abs_in', 'abs')
            ->select('abs.abs_date', 'emp.emp_full_name', 'tsk.task_name', 'tsk.task_start_time', 'abs.abs_time', DB::RAW('TIMEDIFF(abs.abs_time,tsk.task_start_time) as waktu_lewat'))
            ->where('abs.status_check_in', 'like', 'Late')
            ->join('tbl_task as tsk', 'abs.task_id', '=', 'tsk.task_id')
            ->join('emp_person as emp', 'abs.abs_emp_id', '=', 'emp.emp_id')
            ->orderBy('abs.abs_date', 'desc')
            ->get();

        return view('admin.latetime', [
            'absen' => $absen_late
        ]);
    }

    public function attendanceLeaveEarlier()
    {
        $absen_leave_earlier = DB::table('abs_out', 'abs')
            ->select('abs.abs_date', 'emp.emp_full_name', 'tsk.task_name', 'tsk.task_end_time', 'abs.abs_time', DB::RAW('TIMEDIFF(tsk.task_end_time,abs.abs_time) as waktu_lebih'))
            ->where('abs.status_check_out', 'like', 'Leave Earlier')
            ->join('tbl_task as tsk', 'abs.task_id', '=', 'tsk.task_id')
            ->join('emp_person as emp', 'abs.abs_emp_id', '=', 'emp.emp_id')
            ->orderBy('abs.abs_date', 'desc')
            ->get();

        return view('admin.leaveEarlier', [
            'absen' => $absen_leave_earlier
        ]);
    }

    public function attendanceLeaveOnTime()
    {
        $absen_leave_on_time = DB::table('abs_out', 'abs')
            ->select('abs.abs_date', 'emp.emp_full_name', 'tsk.task_name', 'tsk.task_end_time', 'abs.abs_time', DB::RAW('TIMEDIFF(abs.abs_time,tsk.task_end_time) as waktu_lewat'))
            ->where('abs.status_check_out', 'like', 'On Time')
            ->join('tbl_task as tsk', 'abs.task_id', '=', 'tsk.task_id')
            ->join('emp_person as emp', 'abs.abs_emp_id', '=', 'emp.emp_id')
            ->orderBy('abs.abs_date', 'desc')
            ->get();

        return view('admin.lateOnTime', [
            'absen' => $absen_leave_on_time
        ]);
    }

    public function attendanceOvertime()
    {
        $ind_zone = CarbonImmutable::now()->locale('id');
        $weekStartDate = $ind_zone->startOfWeek(Carbon::MONDAY);
        $weekEndDate = $ind_zone->endOfWeek(CARBON::SUNDAY);
    }

    public function attendanceHistory()
    {
        $attendance_history_data = DB::table('absen', 'abs')
            ->select('abs.abs_date', 'emp.emp_full_name', 'tsk.task_name', 'in.status_check_in', 'out.status_check_out')
            ->join('abs_in as in', 'abs.abs_in_id', '=', 'in.abs_in_id')
            ->join('abs_out as out', 'abs.abs_out_id', '=', 'out.abs_out_id')
            ->join('tbl_task as tsk', 'in.task_id', '=', 'tsk.task_id')
            ->join('emp_person as emp', 'abs.abs_emp_id', '=', 'emp.emp_id')
            ->orderBy('abs.abs_date', 'desc')
            ->get();

        // dd($attendance_history_data);
        return view('admin.attendancehistory', [
            'absen' => $attendance_history_data
        ]);
    }

    public function attendanceWeekly()
    {
        // $ind_zone = CarbonImmutable::now()->locale('id');
        // $weekStartDate = $ind_zone->startOfWeek(Carbon::MONDAY);
        // $weekEndDate = $ind_zone->endOfWeek(CARBON::SUNDAY);

        // $attendance_history_weekly_data = DB::table('absen', 'abs')
        //     ->select('abs.abs_date', 'emp.emp_full_name', 'tsk.task_name', 'in.status_check_in', 'out.status_check_out')
        //     ->whereBetween('abs.abs_date', [$weekStartDate, $weekEndDate])
        //     ->join('abs_in as in', 'abs.abs_in_id', '=', 'in.abs_in_id')
        //     ->join('abs_out as out', 'abs.abs_out_id', '=', 'out.abs_out_id')
        //     ->join('tbl_task as tsk', 'in.task_id', '=', 'tsk.task_id')
        //     ->join('emp_person as emp', 'abs.abs_emp_id', '=', 'emp.emp_id')
        //     ->orderBy('abs.abs_date', 'desc')
        //     ->get();

        // $pdf = PDF::loadView('admin.report', ['data' => $attendance_history_weekly_data]);

        // return $pdf->download('Weekl_Attendance_Report.pdf');
    }
}
