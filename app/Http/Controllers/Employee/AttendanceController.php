<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function index()
    {
        return view('employee.attendance', ['today' => Carbon::today()->toDateString(), 'now' => Carbon::now()->toTimeString()]);
    }

  
    public function checkInStore(Request $request)
    {
        $request->validate([
            'emp_id' => 'integer',
            'date' => 'required|date',
            'check_in' => 'required|time',
            'reason' => 'nullable|string',
            'latitude' => 'string',
            'longitude' => 'string',
            'address' => 'string',
            'region' => 'string',
            'zone_time' => 'required|not_in:0'
        ]);

        $emp_id = $request->emp_id;
        $current_date = $request->date;
        $absen = $request->check_in;
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $address = $request->address;
        $region = $request->region;
        $zone_time = $request->zone_time;

        $insert_data = DB::insert('INSERT INTO abs_in
                                (abs_emp_id, abs_date, abs_time, abs_reason, abs_latitude_in, abs_longitude_in, abs_address_in, abs_zone_region_in, abs_zone_time_in) 
                                VALUES (?,?,?,?,?,?,?,?,?)', 
                                [
                                    $emp_id,
                                    $current_date,
                                    $absen,
                                    $latitude,
                                    $longitude,
                                    $address,
                                    $region,
                                    $zone_time
                                ]
                            );
        
        if($insert_data){

            $user_checkin = DB::connection('mysql')->table('abs_in')
                        ->select('abs_in_id', 'abs_emp_id', 'abs_time')
                        ->where('emp_id', '=', $emp_id)
                        ->latest('abs_time')
                        ->get();
            $shift_check_in_awal = strtotime("08:30");
            if($user_checkin->abs_time < $shift_check_in_awal){
                $status_check_in = "On Time";
            }else{
                $status_check_in = "Late";
            }
            DB::insert('INSERT INTO absen
            (abs_emp_id, shift_id, abs_in_id, abs_out_id, status_check_in, status_check_out) 
            VALUES (?,?,?,?,?,?)', 
            [
                $emp_id,
                $user_checkin->abs_in_id,
                0, 
                $status_check_in,
                0
            ]
        );
        }
            
    }

    public function checkOutStore(Request $request){
        $request->validate([
            'emp_id' => 'integer',
            'date' => 'required|datetime',
            'check_out' => 'required|datetime',
            'reason' => 'nullable|string',
            'latitude' => 'string',
            'longitude' => 'string',
            'address' => 'string',
            'region' => 'string',
            'zone_time' => 'required|not_in:0'
        ]);

        $emp_id = $request->emp_id;
        $current_date = $request->date;
        $absen = $request->check_out;
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $address = $request->address;
        $region = $request->region;
        $zone_time = $request->zone_time;

        $user_checkin = DB::connection('mysql')->table('abs_in')
                        ->select('abs_in_id', 'abs_emp_id')
                        ->where('emp_id', '=', $emp_id)
                        ->latest('abs_time')
                        ->get();
        
        DB::insert('INSERT INTO abs_out
                    (abs_emp_id, abs_in_id, abs_date, abs_time, abs_reason, abs_latitude_out, abs_longitude_out, abs_address_out, abs_zone_region_out, abs_zone_time_out) 
                    VALUES (?,?,?,?,?,?,?,?,?,?)', 
                    [
                        $emp_id,
                        $user_checkin->abs_in_id,
                        $current_date,
                        $absen,
                        $latitude,
                        $longitude,
                        $address,
                        $region,
                        $zone_time
                    ]
                );
    }
}
