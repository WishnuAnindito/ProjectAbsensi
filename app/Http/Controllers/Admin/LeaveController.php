<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttendanceEmp;
use App\Models\Leave;
use App\Http\Requests\StoreLeaveRequest;
use App\Http\Requests\UpdateLeaveRequest;
use App\Models\Overtime;
use App\Models\User;
use DateTime;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Hash;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.leave')->with(['leaves' => Leave::all()]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexOverTime()
    {
        return view('admin.overtime')->with(['overtimes' => Overtime::all()]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLeaveRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLeaveRequest $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function assign(AttendanceEmp $request)
    {
        $request->validate();
        if ($employee = User::whereEmail(request('email'))->first()) {
            // if (Hash::check($request->pin_code, $employee->pin_code))
            if (Hash::check($request->password, $employee->password)) {
                if (!Leave::whereLeave_date(date("d-m-Y"))->whereUser_id($employee->id)->first()) {
                    $checkOut = new Leave;
                    $checkOut->user_id = $employee->id;
                    $checkOut->leave_time = date("H:i:s");
                    $checkOut->leave_date = date("d-m-Y");
                    // ontime + overtime if true , else "early go" ....
                    if ($checkOut->leave_time >= $employee->schedules->first()->time_out) {
                        LeaveController::overTime($employee);
                        
                    } else {
                        $checkOut->status = 0;
                    }

                    $checkOut->save();
                } else {
                    return redirect()->route('leave.login')->with('error', 'you assigned your leave before');
                }
            } else {
                return redirect()->route('leave.login')->with('error', 'Failed to assign the leave');
            }
        }



        return redirect()->route('home')->with('success', 'Successful in assign the leave');
    }


    /**
     * assign over time for leave .
     *
     * @return \Illuminate\Http\Response
     */
    public static function overTime(User $employee)
    {
        $current_t = new DateTime(date("H:i:s"));
        $start_t = new DateTime($employee->schedules->first()->time_out);
        $difference = $start_t->diff($current_t)->format('%H:%I:%S');

        $overtime = new Overtime;
        $overtime->user_id = $employee->id;
        $overtime->duration   = $difference;
        $overtime->overtime_date  = date("Y-m-d");
        $overtime->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function show(Leave $leave)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function edit(Leave $leave)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLeaveRequest  $request
     * @param  \App\Models\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLeaveRequest $request, Leave $leave)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function destroy(Leave $leave)
    {
        //
    }
}
