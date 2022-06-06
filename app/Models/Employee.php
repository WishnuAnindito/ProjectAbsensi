<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Employee extends Model
{
    use Notifiable;

    protected $table = 'emp_person';

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function absen(){
        return $this->hasMany(Absen::class);
    }
    
    public function absenIn(){
        return $this->hasMany(AbsenIn::class);
    }

    public function absenOut(){
        return $this->hasMany(AbsenOut::class);
    }

    public function attendance(){
        return $this->hasMany(Attendance::class);
    }

    public function department(){
        return $this->hasMany(Department::class);
    }

    public function division(){
        return $this->hasMany(Division::class);
    }
    
    public function position(){
        return $this->hasMany(Position::class);
    }

    public function empPost(){
        return $this->hasOne(EmpPost::class);
    }

    public function task(){
        return $this->hasOne(Task::class);
    }

    public function user(){
        return $this->hasOne(User::class);
    }

    public function dept_and_div(){
        $teknisiDD = DB::select('
            SELECT emp_position.emp_pos_id, tbl_department.dept_name,tbl_division.division_name, tbl_position.pos_name
            FROM `emp_position`
            JOIN tbl_users ON emp_position.emp_id = tbl_users.user_id
            JOIN tbl_department ON emp_position.emp_department = tbl_department.dept_id
            JOIN tbl_division ON emp_position.emp_department = tbl_division.division_id
            JOIN tbl_position ON emp_position.emp_position = tbl_position.pos_id
            WHERE tbl_users.user_grade < ?', [3]);
        return $teknisiDD;
    }

    public function leader(){
        $leader = DB::select('
            SELECT emp_position.emp_pos_id, emp_position.emp_coach, emp_position.emp_manager, tbl_users.user_grade 
            FROM `emp_position`
            JOIN tbl_users ON emp_position.emp_id = tbl_users.user_id
            WHERE tbl_users.user_grade < ?', [3]);
        return $leader;
    }

    public function details($emp_id){
        $emp_details = DB::table('emp_position', 'pos')
            ->select(
                'pos.emp_id',
                'emp.emp_birth_date',
                'emp.emp_phone',
                'dpt.dept_name',
                'div.division_name',
                'post.pos_name',
                'emp2.emp_full_name as leader',
                'emp3.emp_full_name as manager',
            )
            ->join('emp_person as emp', 'pos.emp_id', '=', 'emp.emp_id') 
            ->join('emp_person as emp2', 'pos.emp_coach', '=', 'emp2.emp_id') 
            ->join('emp_person as emp3', 'pos.emp_manager', '=', 'emp3.emp_id')
            ->join('tbl_department as dpt', 'pos.emp_department', '=', 'dpt.dept_id')
            ->join('tbl_division as div', 'pos.emp_division', '=', 'div.division_id')
            ->join('tbl_position as post', 'pos.emp_post', '=', 'post.pos_id')
            ->where('pos.emp_id','=',$emp_id)
            ->get();
        return $emp_details;
    }

    protected $fillable = [
        'emp_full_name',
        'emp_birth_date',
        'emp_phone',
        'emp_email_office',
    ];

    protected $hidden = [
        
    ];

    protected $casts = [];

}
