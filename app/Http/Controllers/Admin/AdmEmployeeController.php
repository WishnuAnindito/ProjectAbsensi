<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Absen;
use App\Models\Department;
use App\Models\Division;
use App\Models\Employee;
use App\Models\EmpPost;
use App\Models\Position;
use App\Models\Task;
use App\Models\User;
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
        $absen = new Absen();
        $today = $absen->getDate('today');
        $start_of_Attendance = $absen->getDate('monday');
        $end_of_Attendance = $absen->getDate('sunday');

        $employee = new Employee();
        $emp_details = $employee->details($id);
        
        $attendance_total = Absen::where('abs_emp_id', '=', $id)->count('abs_id');
        $daily_attendance_total = Task::where('task_date', '=', $today)->where('task_assign_to','=', $id)->count('task_id');
        
        $work_hour = $absen->workHour($id,$start_of_Attendance,$end_of_Attendance);

        return view('admin.employeeDetails', [
            'employee' => $emp_details,
            'attendance_total' => $attendance_total,
            'daily_attendance_total' => $daily_attendance_total,
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

    public function storeNewEmployee(StoreEmployeeRequest $request){
        /*
            Data yang tidak dimasukkan :
            $request->username,
            $request->hired_date,
            $request->emp_address,
        */ 
       if($request->validated()){
            $employee =  new Employee();
            $employee->emp_full_name = $request->emp_first_name. " ". $request->emp_last_name;
            $employee->emp_birth_date = $request->emp_birth_date;
            $employee->emp_phone = $request->emp_phone;
            $employee->emp_email_office = $request->emp_email_office;

            if($employee->save()){
                $emp_position = new EmpPost();
                $emp_id = Employee::where('emp_email_office', 'LIKE', $request->emp_email_office)->pluck('emp_id')->latest()->first()->value();
                $emp_position->emp_id = $emp_id;
                $emp_position->emp_department = $request->emp_department;
                $emp_position->emp_division = $request->emp_division;
                $emp_position->emp_post = $request->emp_position;
                $emp_position->emp_grade = NULL;
                $emp_position->emp_coach = NULL;
                $emp_position->em_status = NULL;
                if($emp_position->save()){
                    $users = new User();
                    $users->emp_id = $emp_id;
                    $users->user_name = $request->emp_email_office;
                    $users->user_pass = $request->user_pass;
                    $users->user_grade = NULL;
                    if($users->save()){
                        return redirect()->back()->with('Success', 'New Employee has been Added');
                    }else{
                        return redirect()->back()->with('Failed', 'Fail to add new Employee');
                    }
                }else{
                    return redirect()->back()->with('Failed', 'Fail to add new Employee');
                }
            }else{
                return redirect()->back()->with('Failed', 'Fail to add new Employee');
            }
       }
    }

    public function updateDataEmployee(UpdateEmployeeRequest $request,$emp_id){
        if($request->validated()){
            $data_updated = DB::update(
                'UPDATE emp_position
                INNER JOIN emp_person ON emp_position.emp_id = emp_person.emp_id
                INNER JOIN tbl_users ON emp_position.emp_id = tbl_users.emp_id
                SET 
                    -- emp_person data for update
                    emp_person.emp_full_name = ?,
                    emp_person.emp_birth_date = ?,
                    emp_person.emp_phone = ?,
                    emp_person.emp_email_office = ?,
                    -- emp_position data for update
                    emp_position.emp_department = ?,
                    emp_position.emp_division = ?,
                    emp_position.emp_post = ?,
                    emp_position.emp_grade = ?,
                    emp_position.emp_coach = ?,
                    emp_position.emp_manager = ?,
                    emp_position.emp_status = ?,
                    -- tbl_users data for updated
                    tbl_users.user_name = ?,
                    -- tbl_users.user_pass = ?,
                    tbl_users.user_grade = ?

                WHERE emp_id = ?', 
                [
                    // emp_person request data
                    $request->emp_full_name,
                    $request->emp_birth_date,
                    $request->emp_phone,
                    $request->emp_email_office,
                    // emp_position request data
                    $request->emp_department,
                    $request->emp_division,
                    $request->emp_position,
                    $request->emp_grade,
                    $request->emp_coach,
                    $request->emp_manager,
                    $request->emp_status,
                    // tbl_users request data
                    $request->emp_email_office,
                    $request->emp_user_pass,
                    $request->emp_grade,
                    // condition for updated specific data
                    $emp_id
                ]
            );
            if($data_updated){
                return redirect()->back()->with('Success', 'Employee Data has been Updated');
            }else{
                return redirect()->back()->with('Failed', 'Fail to update employee data');
            }
        }else{
            return redirect()->back()->with('Failed', 'Fail to update employee data');
        }
    }
}
