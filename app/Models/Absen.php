<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Absen extends Model
{
    protected $table = 'absen';

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'abs_emp_id', 'emp_id');
    }

    public function absenIn()
    {
        return $this->belongsTo(AbsenIn::class, 'abs_in_id', 'abs_in_id');
    }

    public function absenOut()
    {
        return $this->belongsTo(AbsenOut::class, 'abs_out_id', 'abs_out_id');
    }

    public function getDate($date){
        $ind = CarbonImmutable::now()->locale('id');
        if($date === 'today'){
            return  Carbon::now()->toDateString();
        }else if($date === 'monday'){
            return $ind->startOfWeek(Carbon::MONDAY);
        }else if($date === 'sunday'){
            return $ind->endOfWeek(Carbon::SUNDAY);
        }else{
            return $date;
        }
    }

    public function workHour($emp_id,$start_date,$end_date){
        $work_hour = DB::table('absen', 'abs')
            ->select(
                DB::raw('SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(absOut.abs_time, absIn.abs_time)))) as total_work_hour')
            )
            ->join('abs_in as absIn', 'abs.abs_in_id', '=', 'absIn.abs_in_id')
            ->join('abs_out as absOut', 'abs.abs_out_id', '=', 'absOut.abs_out_id')
            ->where('abs.abs_emp_id', '=', $emp_id)
            ->whereIn('abs.abs_date', [$start_date,$end_date])
            ->value('total_work_hour');
        return $work_hour;
    }

    public function weeklyAttendanceLogs($start_of_Attendance,$end_of_Attendance){
        $data = DB::table('absen', 'abs')
            ->select('abs.abs_date', 'person.emp_full_name', 'tsk.task_name', 'absIn.status_check_in', 'absOut.status_check_out')
            ->join('emp_person as person', 'abs.abs_emp_id', '=', 'person.emp_id')
            ->join('abs_in as absIn', 'abs.abs_in_id', '=', 'absIn.abs_in_id')
            ->join('abs_out as absOut', 'abs.abs_out_id', '=', 'absOut.abs_out_id')
            ->join('tbl_task as tsk', 'abs.abs_emp_id', '=', 'tsk.task_assign_to')
            ->whereBetween('abs.abs_date', [$start_of_Attendance, $end_of_Attendance], 'and')
            ->get();
        return $data;
    }

    public function logs(){
        $data_logs = DB::table('absen', 'abs')
            ->select(
                'abs.abs_id',
                'abs.abs_date as date', 
                'emp.employee_full_name as emp_name', 
                'absIn.abs_time as check_in_time', 
                DB::raw("TIMEDIFF(absOut.abs_time, absIn.abs_time) as workHour"),
                DB::raw(
                    "TIMEDIFF(
                        SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(absOut.abs_time, absIn.abs_time)))),
                        SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(task_end_time, task_start_time))))
                    ) as Overtime"
                    )
                )
            ->join('emp_person as emp', 'abs.abs_emp_id', '=', 'emp.emp_id')
            ->join('absen_in as absIn', 'abs.abs_in_id', '=', 'absIn.abs_in_id')
            ->join('absen_out as absOut', 'abs.abs_out_id', '=', 'emp.abs_out_id')
            ->join('tbl_task as tsk', 'absIn.task_id', '=', 'tsk.task_id')
            ->groupBy('abs.abs_date', 'DESC');
        return $data_logs;
    }


    protected $fillable = [
        'abs_emp_id',
        'abs_date',
        'abs_in_id',
        'abs_out_id'
    ];

    protected $hidden = [];

    protected $casts = [];
}
