<?php

namespace App\Http\Controllers;

// use App\Models\Admin;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

// use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //tampilan awal dashboard
    {
        $employee_total = count(User::all());
        $attandance_total = count(Attendance::whereAttendance_date(date("d-m-Y"))->get());
        $onTime_employee = count(Attendance::whereAttendance_date(date("d-m-Y"))->whereStatus('On Time')->get());
        $lateTime_employee = count(Attendance::whereAttendance_date(date("d-m-Y"))->whereStatus('Late')->get());

        if ($attandance_total > 0) {
            $percentageOntime = str_split(($onTime_employee / $attandance_total) * 100, 4)[0];
        } else {
            $percentageOntime = 0;
        }

        $data_employee = [$employee_total, $percentageOntime, $onTime_employee, $lateTime_employee];
        return view('admin.index')->with(['data' => $data_employee]);
    }

    public function dailyAttendance(){
        // $date = Carbon::now()->format('l');
        // dd($date);
    }
}
