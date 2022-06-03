<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use App\Models\Department;
use App\Models\Division;
use App\Models\Employee;
use App\Models\Position;
use App\Models\Task;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
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
                'emp.emp_id',
                'emp.emp_full_name',
                'post.pos_name',
                'emp.emp_email_office'
                )
            ->join('emp_person as emp', 'pos.emp_id', '=', 'emp.emp_id')
            ->join('tbl_position as post', 'pos.emp_post', '=', 'post.pos_id')
            ->whereNotIn('pos.emp_grade', [1])
            ->get();

        $total_employee = Employee::all()->pluck('emp_id')->count();

        return view('admin.employee', [
            'position' => $job_title,
            'department' => $department,
            'employees' => $employees,
            'total_employee' => $total_employee
        ]);
    }

    public function employeeDetails($id){
        $today = Carbon::now()->toDateString();
        $ind = CarbonImmutable::now()->locale('id');
        $start_of_Attendance = $ind->startOfWeek(Carbon::MONDAY);
        $end_of_Attendance = $ind->endOfWeek(Carbon::SUNDAY);

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
            ->where('pos.emp_id','=',$id)
            ->get();
        
        $attendance_total = Absen::where('abs_emp_id', '=', $id)->count('abs_id');
        $daily_attendance_total = Task::where('task_date', '=', $today)->where('task_assign_to','=', $id)->count('task_id');
        $work_hour = DB::table('absen', 'abs')
            ->select(
                DB::raw('SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(absOut.abs_time, absIn.abs_time)))) as total_work_hour')
            )
            ->join('abs_in as absIn', 'abs.abs_in_id', '=', 'absIn.abs_in_id')
            ->join('abs_out as absOut', 'abs.abs_out_id', '=', 'absOut.abs_out_id')
            ->where('abs.abs_emp_id', '=', $id)
            ->whereIn('abs.abs_date', [$start_of_Attendance,$end_of_Attendance])
            ->value('total_work_hour');

        return view('admin.employeedetails',[
            'details' => $emp_details,
            'attendance' => $attendance_total,
            'daily_attendance' => $daily_attendance_total,
            'work_hour' => $work_hour
        ]);
    }

    public function employeeDetailsEdit(){
        return view('admin.employeedetailsedit');
    }


    public function createNewEmployee(){
        $departments = Department::all();
        $divisions = Division::all();
        $positions = Position::all();
        return view('admin.newemployee', [
            'departments' => $departments, 
            'divisions' => $divisions, 
            'positions' => $positions
        ]);
    }

    public function storeNewEmployee(Request $request){
        $request->validate([
            'emp_first_name' => 'required',
            'emp_last_name' => 'required',
            'username' => 'required',
            'emp_birth_date' => 'required',
            'emp_phone' => 'required',
            // 'hired_date',
            'emp_department' => 'required',
            'emp_position' => 'required',
            'emp_address' => 'required',
            'emp_email_office' => 'required',
            'user_pass' => 'required',
        ]);
    }
}
