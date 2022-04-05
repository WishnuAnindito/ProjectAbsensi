<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdmAttendanceController extends Controller
{
    public function dailyAttendance(){
        $today = Carbon::now()->format('Y-m-d');
        // $data = DB::connection('mysql')->table('absen')
        //         ->select('absen.*')
        //         ->join('abs_in', 'absen.abs_in_id', '=', 'abs_in.abs_in_id')
        //         ->where('abs_in.abs_date', '=', $today)
        //         ->get();
        $data = DB::connection('mysql')->table('absen')
                    ->select('exec admDailyCheckIn(?)', array($today))->get();
        
        
        return view('admin.attendance', ['attendance', $data]);
    }

    public function weeklyAttendance(){
        $ind = CarbonImmutable::now()->locale('id');
        $start_of_Attendance = $ind->startOfWeek(Carbon::MONDAY);
        $end_of_Attendance = $ind->endOfWeek(Carbon::SUNDAY);
        
        // $report_data = DB::connection('mysql')->table('absen')
        //             ->whereBetween('DAY(abs_date)', [$start_of_Attendance,$end_of_Attendance])
        //             ->get();

        $report_data = DB::connection('mysql')->table('absen')
                    ->select('exec admWeeklyAttendance(?,?)', array($start_of_Attendance,$end_of_Attendance));
        
        return view('admin.attendanceReport', ['report' => $report_data]);
    }

    public function adminDashboard(){
        $database = DB::connection('mysql');

        // Jumlah karyawan teknisi
        $employee_total = 11;

        // Jumlah attendance hari ini
        $attandance_total = $database->table('abs_in')->count('abs_in_id'); 

        // Jumlah attendance yang ontime
        $onTime_employee = $database->table('abs_in')->where('status_check_in', 'like', 'On Time')->get()->count();

        // Jumlah karyawan yang terlambat
        $lateTime_employee =$database->table('abs_in')->where('status_check_in', 'like', 'Late')->get()->count();

        // Persentasi kehadiran
        if ($attandance_total > 0) {
            $percentageOntime = str_split(($onTime_employee / $attandance_total) * 100, 4)[0];
        } else {
            $percentageOntime = 0;
        }

        $data_employee = [$employee_total, $percentageOntime, $onTime_employee, $lateTime_employee];
        return view('admin.dashboard', ['data' => $data_employee]);
    }

    public function lateTimeEmployee(){
        $database = DB::connection('mysql');
        $lateTime_employee = $database->table('abs_in')->where('status_check_in', 'like', 'Late')->get();
        return view('admin.lateTime', ['late' => $lateTime_employee]);
    }

    public function ontTimeEmployee(){
        $database = DB::connection('mysql');
        $onTime_employee = $database->table('abs_in')->where('status_check_in', 'like', 'On Time')->get();
        return view('admin.lateTime', ['onTime' => $onTime_employee]);
    }
}
