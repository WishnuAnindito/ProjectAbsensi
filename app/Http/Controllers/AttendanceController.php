<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
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

}
