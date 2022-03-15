<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttendanceEmp;
use App\Models\Attendance;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use App\Models\LateTime;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the attendance.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.attendance')->with(['attendances' => Attendance::all()]);
    }

    /**
     * Display a listing of the lateTime.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexLateTime()
    {
        return view('admin.latetime')->with(['latetimes' => LateTime::all()]);
    }

    /**
     * assign attendance to employee.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(AttendanceEmp $request){
        $request->validate();
        if($employee = User::whereEmail(request('email'))->first()){
            if(Hash::check($request->password, $employee->password)){
                if(!Attendance::whereAttendance_date(date("d-m-Y"))->whereUser_id($employee->id)->first()){
                    $attendance = new Attendance;
                    $attendance->user_id = $employee->id;
                    $attendance->attendance_time = date("H:i:s");
                    $attendance->attendance_date = date("d-m-Y");

                    // if(!($employee->schedules->first()->time_in))
                }
            }
        }
    }
}
