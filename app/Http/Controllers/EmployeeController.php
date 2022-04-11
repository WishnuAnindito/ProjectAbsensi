<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\AbsenIn;
use App\Models\AbsenOut;
use Carbon\Carbon;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
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
            'longitude' => 'string',
            'latitude' => 'string',
            'address' => 'string',
            'region' => 'string',
            'zone_time' => 'required|not_in:0'
        ]);

        $absen = new AbsenIn();
        $absen->emp_id = Auth::user()->id;
        $absen->abs_date = $request->date;  
        $absen->abs_time = $request->check_in;  
        $absen->abs_reason = $request->reason;  
        $absen->abs_longitude_in = $request->longitude;
        $absen->abs_latitude_in = $request->latitude;  
        $absen->abs_address_in= $request->address;  
        $absen->abs_zone_region_in = $request->region;  
        $absen->abs_zone_time_in = $request->zone_time;
        $absen->status_check_in = 'On Time';
        $absen->save();

        return redirect()->back();
    }

    public function checkOutStore(Request $request, $abs_in_id){
        // Validasi terhadap input pada Form
        $request->validate([
            'date' => 'required|datetime',
            'check_out' => 'required|datetime',
            'reason' => 'nullable|string',
            'latitude' => 'string',
            'longitude' => 'string',
            'address' => 'string',
            'region' => 'string',
            'zone_time' => 'required|not_in:0'
        ]);

        $absen = new AbsenOut();
        $absen->emp_id = Auth::user()->id;
        $absen->abs_in_id = AbsenIn::where('abs_in_id', $abs_in_id)->where('emp_id', '=', Auth::user()->id)->latest();
        $absen->abs_date = $request->date;  
        $absen->abs_time = $request->check_out;  
        $absen->abs_reason = $request->reason;  
        $absen->abs_longitude_out = $request->longitude;
        $absen->abs_latitude_out = $request->latitude;  
        $absen->abs_address_out = $request->address;  
        $absen->abs_zone_region_out = $request->region;  
        $absen->abs_zone_time_out = $request->zone_time;
        $absen->status_check_out = 'On Time';
        $absen->save();
    }

    public function attendanceHistory(){
        $history = DB::conneciton('mysql')->table('absen')->where('emp_id', '=', Auth::user()->id )->get();
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
