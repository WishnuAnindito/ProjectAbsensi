<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('leader.task');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'task_assign_by' => 'required|integer',
            'task_assign_to' => 'required|integer',
            'task_name' => 'required|text',
            'task_date' => 'required|date',
            'task_start_time' => 'required|time',
            'task_end_time' => 'required|time',
            'task_zone_time' => 'required|text',
            'task_address' => 'required|text',
            'task_city' => 'required|text',
            // 'task_emp_status' => 'required|text',
            // 'task_lead_status' => 'required|text',
        ]);


        $task = new Task();
        $task->task_assign_by = $request->task_assign_by;
        $task->task_assign_to = $request->task_assign_to;
        $task->task_name = $request->task_name;
        $task->task_date = $request->task_date;
        $task->task_start_time = $request->task_start_time;
        $task->task_end_time = $request->task_end_time;
        $task->task_zone_time = $request->task_zone_time;
        $task->task_address = $request->task_address;
        $task->task_city = $request->task_city;
        $task->task_emp_status = 'None';
        $task->task_lead_status = 'None';
        $task->save();

        if($task->save()){
            return redirect()->back()->with('Success', 'Task baru berhasil ditambahkan');
        }else{
            return redirect()->back()->with('Failed', 'Task baru gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = DB::select('SELECT * FROM tbl_task WHERE task_id = ?', [$id]);
        return view('leader.taskdetails', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Task::whereId($id)->update($request->all()); 
        return redirect()->back()->with('Updaed', 'Task Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        return redirect()->back()->with('Deleted', 'Task Berhasil Di Delete');
    }
}
