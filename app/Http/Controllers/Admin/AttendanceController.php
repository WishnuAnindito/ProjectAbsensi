<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttendanceEmp;
use App\Models\Attendance;
use App\Models\LateTime;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Hash;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the attendance.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //Menampilkan seluruh data absensi kehadiran karyawan hari ini
    {
        return view('admin.attendance')->with(['attendances' => Attendance::all()]);
    }

    /**
     * Display a listing of the lateTime.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexLateTime() //Menampilkan seluruh data karyawan yang terlambat hari ini
    {
        return view('admin.latetime')->with(['latetimes' => LateTime::all()]);
    }

    /**
     * assign attendance to employee.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(AttendanceEmp $request){ //Input data Attendance ke dalam database
        $request->validate();
        if($employee = User::whereEmail(request('email'))->first()){
            if(Hash::check($request->password, $employee->password)){
                if(!Attendance::whereAttendance_date(date("d-m-Y"))->whereUser_id($employee->id)->first()){
                    $attendance = new Attendance;
                    $attendance->user_id = $employee->id;
                    $attendance->attendance_time = date("H:i:s");
                    $attendance->attendance_date = date("d-m-Y");

                    if(!($employee->schedules->first()->time_in)){
                        $attendance->status = "Terlambat";
                        AttendanceController::lateTime($employee);
                    }
                    $attendance->save();

                    
                }else{
                    return redirect()->route('attendance.login')->with('error', 'your assigned your attendance before');
                }
            }else{
                return redirect()->route('attendance.login')->with('error', 'Failed to assign the attendance');
            }
        }
        return redirect()->route('home')->with('success', 'Successful in assign the attendance');
    }

    /**
     * assign late time for attendace .
     *
     * @return \Illuminate\Http\Response
     */
    public static function lateTime(User $employee){
        $current_time = new DateTime(date("H:i:s"));
        $start_time = new DateTime($employee->schedules->first()->time_in);
        $difference = $start_time->diff($current_time)->format('%H:%I:%S');

        $latetime = new Latetime;
        $latetime->user_id = $employee->id;
        $latetime->duration = $difference;
        $latetime->latetime_date = date("d-m-Y");
        $latetime->save();
    }
}
