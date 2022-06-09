<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Task extends Model
{
    protected $table = 'tbl_task';
    protected $connection = 'mysql';   

    public function employee(){
        return $this->belongsTo(Employee::class, ['task_assign_by', 'task_assign_to'], 'emp_id');
    }

    public function absenIn(){
        return $this->belongsToMany(AbsenIn::class);
    }

    public function dailyTask($require = 'data', $today = 'now',$emp_id){
        if($require === 'total'){
            if($emp_id == 1){
                return Task::where('task_date', '=', $today)->count('task_id');
            }else{
                return Task::where('task_date', '=', $today)->andWhere('task_assign_to', '=', $emp_id)->count('task_id');
            }
        }else{
            if($emp_id == 1){
                return Task::where('task_date', '=', $today)->get();
            }else{
                return Task::where('task_date', '=', $today)->andWhere('task_assign_to', '=', $emp_id)->get();
            }
        } 
    }

    public function details($absen_id){
        $att_details = DB::table('absen', 'abs')
            ->select(
                'dpt.dept_name as department',
                'div.division_name as division',
                'post.pos_name as position',
                'emp3.emp_full_name as leader',
                'emp4.emp_full_name as manager',
                'tsk.task_name as task_name',
                'emp5.emp_full_name as task_assign_by',
                'tsk.task_start_time',
                'tsk.task_end_time',
                'tsk.task_address',
                'tsk.task_emp_status as status',
                'absIn.abs_time as abs_in_time',
                'absIn.status_check_in',
                'absIn.abs_reason as abs_in_summary',
                'absOut.abs_time as abs_out_time',
                'absOut.status_check_out',
                DB::raw('TIMEDIFF(absIn.abs_time,tsk.task_start_time) as time_diff'),
                DB::raw('TIMEDIFF(absOut.abs_time,tsk.task_end_time) as time_diff'),
                'absOut.abs_reason as abs_out_summary'
            )
            ->join('emp_position as emp1', 'abs.abs_emp_id', '=', 'emp1.emp_id')
            ->join('emp_person as emp2', 'emp1.emp_id', '=', 'emp2.emp_id') 
            ->join('emp_person as emp3', 'emp1.emp_coach', '=', 'emp3.emp_id') 
            ->join('emp_person as emp4', 'emp1.emp_manager', '=', 'emp4.emp_id')
            ->join('tbl_department as dpt', 'emp1.emp_department', '=', 'dpt.dept_id')
            ->join('tbl_division as div', 'emp1.emp_division', '=', 'div.division_id')
            ->join('tbl_position as post', 'emp1.emp_post', '=', 'post.pos_id')
            ->join('abs_in as absIn', 'abs.abs_in_id', '=','absIn.abs_in_id') 
            ->join('abs_out as absOut', 'abs.abs_out_id', '=','absOut.abs_out_id')
            ->join('tbl_task as tsk', 'absIn.task_id', '=', 'tsk.task_id')
            ->join('emp_person as emp5', 'tsk.task_assign_by', '=', 'emp5.emp_id')
            ->where('abs.abs_id', '=', $absen_id)
            ->get();
        return $att_details;
    }

    protected $fillable = [
        'task_assign_by',
        'task_assign_to',
        'task_name',
        'task_date',
        'task_start_time',
        'task_end_time',
        'task_zone_time',
        'task_address',
        'task_city',
    ];

   
    protected $hidden = [];

   
    protected $casts = [];

}
