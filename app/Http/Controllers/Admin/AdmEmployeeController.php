<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdmEmployeeController extends Controller
{
    public function employeeList()
    {

        // Picture Not Available
        $job_title = Position::all();
        $department = Department::all();
        $employees = DB::table('emp_position', 'pos')
            ->select(
                'emp.emp_full_name',
                'post.pos_name',
                'emp.emp_email_office'
                )
            ->join('emp_person as emp', 'pos.emp_id', '=', 'emp.emp_id')
            ->join('tbl_position as post', 'pos.emp_post', '=', 'post.pos_id')
            ->whereNotIn('pos.emp_grade', [1])
            ->get();


        return view('admin.employee', [
            'position' => $job_title,
            'department' => $department,
            'employees' => $employees
        ]);
    }

    public function employeeDetails($emp_id){
        $employee = DB::table('emp_position', 'pos')
        ->select(
            ''
        )
        ->join('emp_person as emp', 'pos.emp_id', '=', 'emp.emp_id')
        ->where('pos.emp_id', '=', $emp_id);
        
    }

    public function editEmployeeDetails(Request $request, $emp_id){
        
    }
}
