    <?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('leader.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mysql = DB::connection('mysql');
        // $department = $mysql->table('tbl_department')->get('dept_name');
        // $division = $mysql->table('tbl_division')->get('division_name');
        $employee = $mysql->table('emp_position', 'emp')
            ->select('emp.emp_id', 'emp_person.emp_full_name', 'tbl_department.dept_name')
            ->join('emp_person', 'emp.emp_id', '=', 'emp_person.emp_id')
            ->join('tbl_department', 'emp.emp_department', '=', 'tbl_department.dept_id')
            ->where('emp.emp_coach', '=', Auth::user()->emp_id)
            ->orWhere('emp.emp_manager', '=', Auth::user()->emp_id)
            ->get();
        return view('leader.assign',['employee' => $employee]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'emp_id' => 'required|not_in:0',
            'task_name' => 'required|string',
            'date' => 'required|date',
            'time_in' => 'required|time',
            'time_out' => 'required|time',
            'location' => 'required'
        ]);

        $leader = Auth::user()->emp_id;
    
        // $mysql = DB::connection('mysql');
        $newTask = DB::insert(
            'INSERT INTO tbl_schedule (leader_id, emp_id, task_name, date, time_in, time_out, location) 
            VALUES (?,?,?,?,?,?,?)', 
            [
                $leader, 
                $request->emp_id,
                $request->task_name,
                $request->date,
                $request->time_in,
                $request->tim_out,
                $request->location,
            ]);
        
        if($newTask){
            echo "Berhasil melakukan Assignment baru!!!";
        }else{
            echo "Gagal melakukan Assignment Baru";
        }

        return redirect()->back();
    }
}
