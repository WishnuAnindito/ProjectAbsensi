<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbsenIn extends Model
{
    protected $table = 'abs_in';

    // Database Relation
    public function absen()
    {
        return $this->hasOne(Absen::class, 'abs_in_id', 'abs_in_id');
    }

    public function absenOut()
    {
        return $this->hasOne(AbsenOut::class, 'abs_in_id', 'abs_in_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'abs_emp_id', 'emp_id');
    }

    // Absensi Total dan Data
    public function attendanceToday($require = 'data', $today = 'now'){
        if($require === 'total'){
            return AbsenIn::where('abs_date', '=', $today)->count();
        }else{
            return AbsenIn::where('abs_date', '=', $today)->get();
        }
    }

    public function onTimeEmployeeDaily($require = 'data', $today = 'now'){
        if($require === 'total'){
            return AbsenIn::where('status_check_in', 'like', 'On Time')->where('abs_date', '=', $today)->count('abs_in_id');
        }else{
            return AbsenIn::where('status_check_in', 'like', 'On Time')->where('abs_date', '=', $today)->get();
        }
    }

    public function lateTimeEmployeeDaily($require = 'data', $today = 'now'){
        if($require === 'total'){
            return AbsenIn::where('status_check_in', 'like', 'Late')->where('abs_date', '=', $today)->count('abs_in_id');
        }else{
            return AbsenIn::where('status_check_in', 'like', 'Late')->where('abs_date', '=', $today)->get();
        }
    }

    // CRUD
    public function insertData($request,$task_id,$emp_id){
        $task_time = Task::where('task_id', '=', $task_id)->pluck('task_start_time')->first()->value();

        $absenIn = new AbsenIn();
        $absenIn->abs_emp_id = $emp_id;
        $absenIn->task_id = $task_id;
        $absenIn->abs_date = $request->abs_date;
        $absenIn->abs_time = $request->abs_time;
        $absenIn->abs_reason = $request->abs_reason;
        $absenIn->abs_longitude_in = $request->abs_longitude_in;
        $absenIn->abs_address_in = $request->abs_address_in;
        $absenIn->abs_zone_region_in = $request->abs_zone_region_in;
        $absenIn->abs_zone_time_in = $request->abs_zone_time_in;
        if($request->abs_time > $task_time){
            $absenIn->status_check_in = 'Late';
        }else{
            $absenIn->status_check_in = 'On Time';
        }
        
        if($absenIn->save()){
            return true;
        }else{
            return false;
        }
    }

    public function updateData($request, $abs_in_id){
        $update_data = AbsenIn::where('abs_in_id', $abs_in_id)->update(
            [
                'abs_date' => $request->abs_date,
                'abs_time' => $request->abs_time,
                'abs_reason' => $request->abs_reason,
                'abs_latitude_in' => $request->abs_latitude_in,
                'abs_longitude_in' => $request->abs_longitude_in,
                'abs_address_in' => $request->abs_address_in,
                'abs_zone_region_in' => $request->abs_zone_region_in,
                'abs_zone_time_in' => $request->abs_zone_time_in,
            ]
        );

       if($update_data){
           return true;
       }else{
           return false;
       }
    }

    public function deleteData($abs_in_id){
        $delete = AbsenIn::where('abs_in_id', $abs_in_id)->delete();
        if($delete){
            return true;
        }else{
            return false;
        }
    }


    // Model Requirements
    protected $fillable = [
        'abs_emp_id',
        'abs_task_id',
        'abs_date',
        'abs_time',
        'abs_reason',
        'abs_latitude_in',
        'abs_longitude_in',
        'abs_address_in',
        'abs_zone_region_in',
        'abs_zone_time_in',
        'status_check_in'
    ];

    protected $hidden = [];

    protected $casts = [];
}
