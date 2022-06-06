<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SampinganController extends Controller
{
    public function index()
    {
        $today = Carbon::now()->format('Y-m-d');
        $ind = CarbonImmutable::now()->locale('id');
        $start_of_Attendance = $ind->startOfWeek(Carbon::MONDAY);
        $end_of_Attendance = $ind->endOfWeek(Carbon::SUNDAY);

        $emp_profile = DB::table('emp_position', 'pos')
            ->select('person.emp_full_name', 'post.pos_name', 'img.emp_img_file')
            ->join('emp_person as person', 'pos.emp_id', '=', 'person.emp_id')
            ->join('tbl_position as post', 'pos.emp_position', '=', 'post.pos_id')
            ->join('emp_images as img', 'pos.emp_id', '=', 'img.emp_id')
            ->where('img.emp_img_name', 'like', 'Photo Profile');
        $emp_task = DB::table('tbl_task')
            ->where('task_assign_to', '=', Auth::user()->id)
            ->where('task_date', '=', $today)
            ->get();

        $work_hour = DB::table('absen', 'abs')
                ->select('HOUR(SEC_TO_TIME(SUM(TIME_TO_SEC(absOut.abs_time - absIn.abs_time)))) as `WorkHour`')
                ->join('abs_in as absIn', 'abs.abs_in_id', '=', 'absIn.abs_in_id')
                ->join('abs_out as absOut', 'abs.abs_out_id', '=', 'absIn.abs_out_id')
                ->whereBetween('abs.abs_date', [$start_of_Attendance, $end_of_Attendance], 'and');
    
        return view('employee.dashboard', [
            'profile' => $emp_profile,
            'task' => $emp_task,
            'workhour' => $work_hour
        ]);
    }

    public function historyPage() {
        return view('employee.history');
    }

    public function history($id, $date)
    {
        $emp_task = DB::table('tbl_task')
            ->where('task_assign_to', '=', $id)
            ->where('task_date', '=', $date)
            ->get();

        $emp_absen = DB::table('absen', 'abs')
            ->select('absIn.abs_time', 'absOut.abs_time', 'absIn.status_check_in', 'absOut.status_check_out')
            ->join('abs_in as absIn', 'abs.abs_in_id', '=','absIn.abs_in_id')
            ->join('abs_out as absOut', 'abs.abs_out_id', '=','absIn.abs_out_id')
            ->where('abs.emp_id', '=', $id)
            ->where('abs.date', '=', $date)
            ->get();
        
        return view('employee.history', [
            'task' => $emp_task,
            'absen' => $emp_absen
        ]);
    }


    public function checkInStore(Request $request){
        $request->validate([
            'task_id' => 'required|integer',
            'date' => 'required|date',
            'time' => 'required|time',
            'reason' => 'nullable|text',
            'longitude' => 'required|text',
            'latitude' => 'required|text',
            'address' => 'required|text',
            'region' => 'required|text',
            'zone_time' => 'required|text',
        ]);


        $emp_task = DB::table('tbl_task')
                ->where('task_id', '=', $request->task_id)
                ->get();

        $absen = new AbsenIn();
        $absen->emp_id = Auth::user()->id;
        $absen->task_id = $request->task_id;
        $absen->abs_date = $request->date;  
        $absen->abs_time = $request->time;  
        $absen->abs_reason = $request->reason;  
        $absen->abs_longitude_in = $request->longitude;
        $absen->abs_latitude_in = $request->latitude;  
        $absen->abs_address_in= $request->address;  
        $absen->abs_zone_region_in = $request->region;  
        $absen->abs_zone_time_in = $request->zone_time;
        if($request->abs_time > $emp_task->task_start_time){
            $absen->status_check_in = 'Late';
        }else{
            $absen->status_check_in = 'On Time';
        }

        if($absen->save()){
            DB::update(
                'UPDATE tbl_task SET task_emp_status =  ? , task_lead_status = ? WHERE task_id = ?', ['Check In', 'Waiting for Approval', $request->task_id]
            );

            return redirect()->back()->with('Success', 'Anda berhasil melakukan ChecIn');
        }else{
            return redirect()->back()->with('Failed', 'Gagal melakukan CheckIn');
        }
    }

    public function checkOutStore(Request $request){
        $request->validate([
            'task_id' => 'required|integer',
            'date' => 'required|date',
            'time' => 'required|time',
            'reason' => 'nullable|text',
            'longitude' => 'required|text',
            'latitude' => 'required|text',
            'address' => 'required|text',
            'region' => 'required|text',
            'zone_time' => 'required|text',
        ]);


        $abs_data = DB::table('abs_in', 'absIn')
                ->select('absIn.task_id', 'absIn.abs_in_id', 'tsk.task_end_time')
                ->join('tbl_task as tsk', 'absIn.task_id', '=', 'tsk.task_id')
                ->where('absIn.task_id', '=', $request->task_id)
                ->get();

        $absen = new AbsenOut();

        $absen->emp_id = Auth::user()->id;
        $absen->abs_in_id = $abs_data->abs_in_id;
        $absen->abs_date = $request->date;  
        $absen->abs_time = $request->time;  
        $absen->abs_reason = $request->reason;  
        $absen->abs_longitude_out = $request->longitude;
        $absen->abs_latitude_out = $request->latitude;  
        $absen->abs_address_out= $request->address;  
        $absen->abs_zone_region_out = $request->region;  
        $absen->abs_zone_time_out = $request->zone_time;

        if($request->abs_time < $abs_data->task_end_time){
            $absen->status_check_out = 'Leave Earlier';
        }else{
            $absen->status_check_out = 'On Time';
        }

        if($absen->save()){
            $absen_out = DB::table('abs_out')->where('abs_in_id', '=', $abs_data->abs_in_id)->get();

            $attendance = new Absen();
            $attendance->abs_emp_id = Auth::user()->id;
            $attendance->abs_date = $request->date;
            $attendance->abs_in_id = $abs_data->abs_in_id;
            $attendance->abs_out_id = $absen_out->abs_out_id;

            if($attendance->save()){
                return redirect()->back()->with('Success', 'Anda berhasil melakukan ChecIn');
            }else{
                return redirect()->back()->with('Failed', 'Gagal melakukan CheckIn');
            }
        }else{
            return redirect()->back()->with('Failed', 'Gagal melakukan CheckIn');
        }
    }
}
