<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employee.attendance', ['today' => Carbon::today()->toDateString(), 'now' => Carbon::now()->toTimeString()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'emp_id' => 'integer',
            'check_in' => 'required|datetime',
            'latitude' => 'string',
            'longitude' => 'string',
            'address' => 'string',
            'region' => 'string',
            'zone_time' => 'required|not_in:0'
        ]);

        $emp_id = $request->emp_id;
        $check = 

        $users_data = DB::connection('mysql')->table('emp_person','ep')
                    ->select(
                        'ep.emp_id',
                        'ep.emp_full_name',
                        'tbl_users.emp_grade',
                        'emp_position.emp_division',
                        'emp_position.emp_department',
                        'emp_coach.emp_coach',
                        'emp_coach.emp_manager',
                        )
                    ->join('emp_position','ep.emp_id', '=', 'emp_position.emp_id')
                    ->join('tbl_users', 'ep.emp_id', '=', 'tbl_users.user_id')
                    ->where('ep.emp_id', '=', $emp_id)
                    ->get();

        $current_date = Carbon::now()->toDateString();
        $current_hour = Carbon::now()->toTimeString();

        
        DB::insert('INSERT INTO tbl_absence 
                    (abs_emp_id, abs_emp_name, abs_emp_grade, abs_emp_division, abs_emp_dept,
                    abs_emp_coach, abs_emp_manager, abs_date, abs_check_in,
                    abs_latitude_in, abs_longitude_in, abs_address_in, abs_zone_region_in, abs_zone_time_in) 
                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)', 
                    [
                        $users_data->emp_id,
                        $users_data->emp_full_name,
                        $users_data->emp_grade,
                        $users_data->emp_division,
                        $users_data->emp_department,
                        $users_data->emp_coach,
                        $users_data->emp_manager,
                        $current_date,
                        $current_hour,
                        $users_data->emp_id,
                        $users_data->emp_id,
                        $users_data->emp_id,
                        $users_data->emp_id,
                    ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function update($id){

    }
}
