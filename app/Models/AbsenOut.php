<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AbsenOut extends Model
{
    protected $table = 'abs_out';

    // Relation Database
    public function absen(){
        return $this->hasOne(Absen::class, 'abs_out_id', 'abs_out_id');
    }

    public function employee(){
        return $this->belongsTo(Employee::class, 'abs_emp_id', 'emp_id');
    }

    public function absenIn(){
        return $this->belongsTo(absenIn::class, 'abs_in_id', 'abs_in_id');
    }


    // CRUD
    public function insertData($request){
        $task = DB::table('abs_in','abs')
            ->select('abs.abs_in_id', 'abs.task_id', 'tsk.task_end_time')
            ->join('tbl_task as tsk', 'abs.task_id', '=', 'tsk.task_id')
            ->where('abs.task_id', '=', $request->task_id)
            ->get();

        $absenOut = new AbsenOut();
        $absenOut->abs_emp_id = $request->abs_emp_id;
        $absenOut->abs_in_id = $task->abs_in_id;
        $absenOut->abs_date = $request->abs_date;
        $absenOut->abs_time = $request->abs_time;
        $absenOut->abs_reason = $request->abs_reason;
        $absenOut->abs_longitude_Out = $request->abs_longitude_Out;
        $absenOut->abs_address_out = $request->abs_address_out;
        $absenOut->abs_zone_region_out = $request->abs_zone_region_out;
        $absenOut->abs_zone_time_out = $request->abs_zone_time_out;
        if($request->abs_time < $task->task_end_time){
            $absenOut->status_check_out = 'Leave Earlier';
        }else{
            $absenOut->status_check_out = 'On Time';
        }
        
        if($absenOut->save()){
            return true;
        }else{
            return false;
        }
    }

    public function updateData($request, $abs_out_id){
        $update_data = AbsenOut::where('abs_out_id', $abs_out_id)->update(
            [
                'abs_date' => $request->abs_date,
                'abs_time' => $request->abs_time,
                'abs_reason' => $request->abs_reason,
                'abs_latitude_out' => $request->abs_latitude_out,
                'abs_longitude_out' => $request->abs_longitude_out,
                'abs_address_out' => $request->abs_address_out,
                'abs_zone_region_out' => $request->abs_zone_region_out,
                'abs_zone_time_out' => $request->abs_zone_time_out,
            ]
        );

       if($update_data){
           return true;
       }else{
           return false;
       }
    }

    public function deleteData($abs_out_id){
        $delete = AbsenOut::where('abs_out_id', $abs_out_id)->delete();
        if($delete){
            return true;
        }else{
            return false;
        }
    }
    protected $fillable = [
        'abs_emp_id',
        'abs_in_id',
        'abs_date',
        'abs_time',
        'abs_reason',
        'abs_latitude_out',
        'abs_longitude_out',
        'abs_address_out',
        'abs_zone_region_out',
        'abs_zone_time_out',
        'status_check_out'
    ];

    protected $hidden = [];

    protected $casts = [];
}
