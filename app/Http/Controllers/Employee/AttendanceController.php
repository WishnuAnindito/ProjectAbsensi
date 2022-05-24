<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mockery\Generator\StringManipulation\Pass\Pass;

class AttendanceController extends Controller
{
    public function index()
    {
        return view('employee.attendance', ['today' => Carbon::today()->toDateString(), 'now' => Carbon::now()->toTimeString()]);
    }

  
    public function checkInStore(Request $request)
    {
        // Validasi terhadap input pada Form
        $request->validate([
            'date' => 'required|date',
            'check_in' => 'required|time',
            'reason' => 'nullable|string',
            'latitude' => 'string',
            'longitude' => 'string',
            'address' => 'string',
            'region' => 'string',
            'zone_time' => 'required|not_in:0'
        ]);

        // Deklarasi hasil input ke dalam sebuah variable
        // $emp_id = $request->emp_id;
        $emp_id = Auth::user()->id;
        $current_date_in = $request->date;
        $absen_in = $request->check_in;
        $latitude_in = $request->latitude;
        $longitude_in = $request->longitude;
        $address_in = $request->address;
        $region_in = $request->region;
        $zone_time_in = $request->zone_time;

        // Insert data ke dalam database abs_in
        $insert_data_to_abs_in = DB::insert('INSERT INTO abs_in
                                (abs_emp_id, abs_date, abs_time, abs_reason, abs_latitude_in, abs_longitude_in, abs_address_in, abs_zone_region_in, abs_zone_time_in) 
                                VALUES (?,?,?,?,?,?,?,?,?)', 
                                [
                                    $emp_id,
                                    $current_date_in,
                                    $absen_in,
                                    $latitude_in,
                                    $longitude_in,
                                    $address_in,
                                    $region_in,
                                    $zone_time_in
                                ]
                            );
        if($insert_data_to_abs_in){
            echo "CheckIn berhasil";
        }else{
            echo "CheckIn tidak dapat dilakukan";
        }
    }

    public function checkOutStore(Request $request){
        // Validasi terhadap input pada Form
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

        // Deklarasi hasil input ke dalam sebuah variable
        $emp_id = $request->emp_id;
        $current_date_out = $request->date;
        $absen_out = $request->check_out;
        $latitude_out = $request->latitude;
        $longitude_out = $request->longitude;
        $address_out = $request->address;
        $region_out = $request->region;
        $zone_time_out = $request->zone_time;

         // mengambil data berupa abs_in_id dan emp_id
        $user_checkin = DB::connection('mysql')->table('abs_in')
                        ->select('abs_in_id', 'abs_emp_id')
                        ->where('emp_id', '=', $emp_id)
                        ->latest('abs_time')
                        ->get();
        
        $insert_data_to_abs_out = DB::insert('INSERT INTO abs_out
                                    (abs_emp_id, abs_in_id, abs_date, abs_time, abs_reason, abs_latitude_out, abs_longitude_out, abs_address_out, abs_zone_region_out, abs_zone_time_out) 
                                    VALUES (?,?,?,?,?,?,?,?,?,?)', 
                                    [
                                        $emp_id,
                                        $user_checkin->abs_in_id,
                                        $current_date_out,
                                        $absen_out,
                                        $latitude_out,
                                        $longitude_out,
                                        $address_out,
                                        $region_out,
                                        $zone_time_out
                                    ]
                                );
        
        // PERLU DIPINDAHKAN
        // if($insert_data_to_abs_out){
        //     $abs_user_data = DB::connection('mysql')->table('abs_out')
        //     ->select('abs_out.emp_id', 'abs_out.abs_in_id', 'abs_out_id', 'abs_in.abs_time as abs_awal', 'abs_out.abs_time as abs_akhir')
        //     ->join('abs_in', 'abs_out.abs_in_id', '=', 'abs_in.abs_in_id')
        //     ->where('abs_out.emp_id', '=', $emp_id)
        //     ->latest()
        //     ->get();

        //     $abs_time_in = strtotime("08:30");
        //     $abs_time_out = strtotime("17:30");
            
        //     if($abs_user_data->abs_awal < $abs_time_in){
        //         $abs_status_in = "On Time";
        //     }else{
        //         $abs_status_in = "On Time";
        //     }

        //     if($abs_user_data->abs_akhir < $abs_time_out){
        //         $abs_status_out = "Leave Earlier";
        //     }else{
        //         $abs_status_out = "On Time";
        //     }

        //     $insert_data_to_absen = 
        //                 DB::insert('INSERT INTO absen (abs_emp_id, abs_date, abs_in_id, abs_out_id, status_check_in, status_check_out) 
        //                 VALUES (?, ?, ?, ?, ?, ?)', 
        //                 [
        //                     $abs_user_data->emp_id, 
        //                     $current_date_out,
        //                     $abs_user_data->abs_in_id,
        //                     $abs_user_data->abs_out_id,
        //                     $abs_status_in,
        //                     $abs_status_out
        //                 ]);

        //     if($insert_data_to_absen){
        //         echo "Berhasil Melakukan Checkout";
        //     }
        // }else{
        //     echo "Gagal Melakukan Checkout";
        // }
    }

    public function attendanceHistory($id){
        $history = DB::conneciton('mysql')->table('absen')->where('emp_id', '=', $id)->get();
        return view('employee.history', ['history' => $history]);
    }

    public function checkInHistory($id){
        $history = DB::conneciton('mysql')->table('abs_in')->where('emp_id', '=', $id)->get();
        return view('employee.checkInHistory', ['history' => $history]);
    }
    
    public function checkOutHistory($id){
        $history = DB::conneciton('mysql')->table('abs_out')->where('emp_id', '=', $id)->get();
        return view('employee.checkOutHistory', ['history' => $history]);
    }
    
    function sendNotif($emp_name, $emp_lead, $lead_number){

    }

    // New BackEnd
    public function empDashboard()
    {
        $id = Auth::user()->emp_id;
        $today = Carbon::now()->toDateString();
        $attendance_total = Absen::where('abs_emp_id', '=', $id)->count();
        $task_today_total = Task::where('task_assign_to', '=', $id)->where('task_date', '=', $today)->count();
        // $task_today = Task::where('task_assign_to', '=', $id)->where('task_date', '=', $today)->get();
        $task_today = Task::where([
            ['task_assign_to', '=', $id],
            ['task_date', '=', $today]
        ])->get();

        return view('employee.dashboard', [
            'tsk_today' => $task_today,
            'tsk_today_total' => $task_today_total,
            'attendance_total' => $attendance_total
        ]);
    }

    public function empCheckIn(Request $request, $task_id)
    {
        /*
            protected $fillable = [
                'abs_emp_id', (auto)
                'abs_date', (auto)
                'abs_time', (auto)
                'abs_reason', (input)
                'abs_latitude_in', (auto)
                'abs_longitude_in', (auto)
                'abs_address_in', (auto)
                'abs_zone_region_in', (auto)
                'abs_zone_time_in', (auto)
                'status_check_in' (coding)
            ];
        */
        $id = Auth::user()->emp_id;
        $task = Task::where('task_id', '=', $task_id)->get();

        $request->validate([
            'abs_reason' => 'required|string'
        ]);

        $absenIn = new AbsenIn();
        $absenIn->abs_emp_id = $id;
        $absenIn->abs_date = $request->abs_date;
        $absenIn->abs_time = $request->abs_time;
        $absenIn->abs_reason = $request->abs_reason;
        $absenIn->abs_latitude_in = $request->abs_latitude_in;
        $absenIn->abs_longitude_in = $request->abs_longitude_in;
        $absenIn->abs_address_in = $request->abs_address_in;
        $absenIn->abs_zone_region_in = $request->abs_zone_region_in;
        $absenIn->abs_zone_time_in = $request->abs_zone_time_in;
        if ($request->abs_time > $task->task_start_time) {
            $absenIn->status_check_in = 'Late';
        } else {
            $absenIn->status_check_in = 'On Time';
        }

        // $absenIn->save();
        if ($absenIn->save()) {
            return redirect()->back()->with('Success', 'Anda Berhasil Melakukan Check In');
        } else {
            return redirect()->back()->with('Failed', 'Anda Gagal Melakukan Check In');
        }
    }

    public function empCheckOut(Request $request, $task_id, $abs_in_id)
    {
        /*
            protected $fillable = [
                'abs_emp_id', (auto)
                'abs_in_id', (auto)
                'abs_date', (auto)
                'abs_time', (auto)
                'abs_reason', (input)
                'abs_latitude_out', (auto)
                'abs_longitude_out', (auto)
                'abs_address_out', (auto)
                'abs_zone_region_out', (auto)
                'abs_zone_time_out', (auto)
                'status_check_out' (coding)
            ];
        */
        $id = Auth::user()->emp_id;
        $task = Task::where('task_id', '=', $task_id)->get();

        $request->validate([
            'abs_reason' => 'required|string'
        ]);

        $absenOut = new AbsenOut();
        $absenOut->abs_emp_id = $id;
        $absenOut->abs_in_id = $abs_in_id;
        $absenOut->abs_date = $request->abs_date;
        $absenOut->abs_time = $request->abs_time;
        $absenOut->abs_reason = $request->abs_reason;
        $absenOut->abs_latitude_out = $request->abs_latitude_out;
        $absenOut->abs_longitude_out = $request->abs_longitude_out;
        $absenOut->abs_address_out = $request->abs_address_out;
        $absenOut->abs_zone_region_out = $request->abs_zone_region_out;
        $absenOut->abs_zone_time_out = $request->abs_zone_time_out;
        if ($request->abs_time > $task->task_start_time) {
            $absenOut->status_check_Out = 'On Time';
        } else {
            $absenOut->status_check_Out = 'Leave Earlier';
        }

        // $absenOut->save();
        if ($absenOut->save()) {
            return redirect()->back()->with('Success', 'Anda Berhasil Melakukan Check Out');
        } else {
            return redirect()->back()->with('Failed', 'Anda Gagal Melakukan Check Out');
        }
    }


    public function empProfile($user_id)
    {
        /*
            Date Hired belum tersedia
        */

        $ind_zone = CarbonImmutable::now()->locale('id');
        $weekStartDate = $ind_zone->startOfWeek(Carbon::MONDAY);
        $weekEndDate = $ind_zone->endOfWeek(CARBON::SUNDAY);

        // $id = Auth::user()->emp_id;

        $task = Task::where('task_assign_to', '=', $user_id)->get();
        $task_total = Task::whereBetween('task_date', [$weekStartDate, $weekEndDate])->where('task_assign_to', '=', $user_id)->count();
        $work_hour = DB::table('absen', 'abs')
            ->select(DB::raw('SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(absOut.abs_time, absIn.abs_time)))) as workHour'))
            ->join('abs_in as absIn', 'abs.abs_in_id', '=', 'absIn.abs_in_id')
            ->join('abs_out as absOut', 'abs.abs_out_id', '=', 'absOut.abs_out_id')
            ->whereBetween('abs.abs_date', [$weekStartDate, $weekEndDate])
            ->where('abs.abs_emp_id', '=', 40)
            ->get();

        // dd($weekStartDate, $weekEndDate);

        $employee_data = DB::table('emp_position', 'post')
            ->selet(
                'emp.emp_full_name',
                'pos.pos_name',
                'dpt.dept_name',
                'emp2.emp_full_name',
                'div.division_name',
                'emp3.emp_full_name',

            )
            ->join('emp_person as emp', 'post.emp_id', '=', 'emp.emp_id')
            ->join('tbl_position as pos', 'post.emp_position', '=', 'pos.pos_id')
            ->join('tbl_department as dpt', 'post.emp_department', '=', 'dpt.dept_id')
            ->join('tbl_division as div', 'pos.emp_division', '=', 'div.division_id')
            ->join('emp_person as emp2', 'post.emp_coach', '=', 'emp2.emp_id')
            ->join('emp_person as emp3', 'post.emp_manager', '=', 'emp3.emp_id')
            ->where('post.emp_id', '=', $user_id)
            ->get();

        return view('employee.profile');
    }


    public function history($emp_id)
    {
        $attendance_history_data = DB::table('absen', 'abs')
            ->select('abs.abs_date', 'emp.emp_full_name', 'tsk.task_name', 'in.status_check_in', 'out.status_check_out')
            ->join('abs_in as in', 'abs.abs_in_id', '=', 'in.abs_in_id')
            ->join('abs_out as out', 'abs.abs_out_id', '=', 'out.abs_out_id')
            ->join('tbl_task as tsk', 'in.task_id', '=', 'tsk.task_id')
            ->join('emp_person as emp', 'abs.abs_emp_id', '=', 'emp.emp_id')
            ->where('abs.emp_id', '=', $emp_id)
            ->orderBy('abs.abs_date', 'desc')
            ->get();

        // dd($attendance_history_data);
        return view('employee.attendancehistory', [
            'absen' => $attendance_history_data
        ]);
    }

    public function weeklyTask($emp_id)
    {
        $ind_zone = CarbonImmutable::now()->locale('id');
        $weekStartDate = $ind_zone->startOfWeek(Carbon::MONDAY);
        $weekEndDate = $ind_zone->endOfWeek(CARBON::SUNDAY);

        $task = Task::where([
            ['task_assign_to', '=', $emp_id],
            ['task_date', 'BETWEEN', $weekStartDate . " and " . $weekEndDate]
        ])->get();

        return view('employee.weeklyTask', [
            'task' => $task
        ]);
    }
}
