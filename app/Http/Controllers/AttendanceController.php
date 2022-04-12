<?php

namespace App\Http\Controllers;

use App\Models\AbsenIn;
use App\Models\EmpPost;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function adminDashboard(){
        // Jumlah karyawan teknisi
        $employee_total = EmpPost::whereIn('emp_grade', ['I','II','III'])->count();

        // Jumlah attendance hari ini
        $attandance_total = AbsenIn::where('abs_date', '=', Carbon::now()->format('Y-m-d'))->count();

        // Jumlah attendance yang ontime
        // $onTime_employee_total = AbsenIn::where('status_check_in', 'LIKE', 'On Time')->count();
        $onTime_employee_total = AbsenIn::where('status_check_in', 'LIKE', 'On Time')
            ->AndWhere('abs_date', '=', Carbon::now()->format('Y-m-d'))->count();

        // Jumlah karyawan yang terlambat
        $lateTime_employee_total = AbsenIn::where('status_check_in', 'LIKE', 'Late')
            ->AndWhere('abs_date', '=', Carbon::now()->format('Y-m-d'))->count();

        // Persentase kehadiran
        if ($attandance_total > 0) {
            $percentageOntime = str_split(($onTime_employee_total / $attandance_total) * 100, 4)[0];
        } else {
            $percentageOntime = 0;
        }

        $onTime_employee = AbsenIn::where('status_check_in', 'LIKE', 'On Time')
            ->AndWhere('abs_date', '=', Carbon::now()->format('Y-m-d'))->get();

        $lateTime_employee = AbsenIn::where('status_check_in', 'LIKE', 'Late')
            ->AndWhere('abs_date', '=', Carbon::now()->format('Y-m-d'))->get();

        // $data_employee = [$employee_total, $percentageOntime, $onTime_employee_total, $lateTime_employee_total];
        return view('admin.dashboard', [
            'employee_total' => $employee_total,
            'attandance_total' => $attandance_total,
            'onTime_employee_total' => $onTime_employee_total,
            'lateTime_employee_total' => $lateTime_employee_total,
            '$percentageOntime' => $percentageOntime,
            '$onTime_employee' => $onTime_employee,
            'lateTime_employee' => $lateTime_employee
        ]);
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
        $database = DB::connection('mysql');
        $lateTime_employee = $database->select('SELECT * FROM abs_in WHERE status_check_in LIKE `Late`');
        return view('admin.lateTime', ['late' => $lateTime_employee]);
    }

    public function ontTimeEmployee(){
        $database = DB::connection('mysql');
        $onTime_employee = $database->select('SELECT * FROM abs_in WHERE status_check_in LIKE `On Time` ');
        return view('admin.lateTime', ['onTime' => $onTime_employee]);
    }

    public function getScheduledEmployee(){
        $database = DB::connection('mysql');
        $schedule = $database->select('SELECT * FROM tbl_schedule WHERE DATE(date) = CURRENT_TIME()');
        return view('admin.schedule',['schedule' => $schedule]);
    }

}
