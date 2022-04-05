<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
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
   
}
