<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function adminDashboard(){
        $database = DB::connection('mysql');

        // Jumlah karyawan teknisi
        $employee_total = $database->table('tbl_users')->where('user_grade', '<', '3')->count();

        // Jumlah attendance hari ini
        $attandance_total = $database->table('abs_in')->count('abs_in_id'); 

        // Jumlah attendance yang ontime
        $onTime_employee = $database->table('abs_in')->where('status_check_in', 'like', 'On Time')->get()->count();

        // Jumlah karyawan yang terlambat
        $lateTime_employee =$database->table('abs_in')->where('status_check_in', 'like', 'Late')->get()->count();

        // Persentase kehadiran
        if ($attandance_total > 0) {
            $percentageOntime = str_split(($onTime_employee / $attandance_total) * 100, 4)[0];
        } else {
            $percentageOntime = 0;
        }

        $data_employee = [$employee_total, $percentageOntime, $onTime_employee, $lateTime_employee];
        return view('admin.dashboard', ['data' => $data_employee]);
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
