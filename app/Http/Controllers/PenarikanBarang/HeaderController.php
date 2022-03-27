<?php

namespace App\Http\Controllers\PenarikanBarang;

use App\Http\Controllers\Controller;
use App\Models\Header;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $header = DB::connection('mysql3')->table('ppb_header')->get();

        return view('PenarikanBarang.headerForm', ['ppb_header' => $header]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get data from database tangara
        $db = DB::connection('mysql');

        // Department data
        $department = $db->table('tbl_department')
            ->select('dept_id', 'dept_code', 'dept_name')
            ->get();

        // Project Desc
        $projects = $db->table('tbl_project')
            ->select('project_desc')
            ->get();    

        // Propose User data
        // $propose = $db->table('emp_person')
        //     ->select('emp_full_name')
        //     ->where('emp_id', '=', Auth::user()->emp_id)
        //     ->first();

        // Get Data from database tm_app

        $db3 = DB::connection('mysql3');

        $po_and_pr = $db3->table('porder')
            ->join('prequest', 'porder.prequest_id', '=', 'prequest.prequest_id')
            ->select('porder.porder_id', 'porder.porder_no', 'prequest.prequest_id', 'prequest.prequest_no')
            ->where(DB::raw('YEAR(dtm_porder)'), '=',  2022)
            ->get();

        // Location Data
        $location = $db3->table('location')
            ->select('location_id','location_name')
            ->get();

        $today = Carbon::now()->toDateString();

        return view(
            'PenarikanBarang.headerForm',
            [
                'department' => $department,
                'po_and_pr' => $po_and_pr,
                'location' => $location,
                'today' => $today,
                'projects' => $projects,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate();
        $data_header = new Header();
        $data_header->ppb_number = $request->ppb_number;
        $data_header->ppb_date = $request->ppb_date;
        $data_header->ppb_pr_id = $request->ppb_pr_id;
        
        
        $db3 = DB::connection('mysql3');

        $po_and_pr = $db3->table('porder')
            ->join('prequest', 'porder.prequest_id', '=', 'prequest.prequest_id')
            ->select('porder.porder_id', 'porder.porder_no', 'prequest.prequest_id', 'prequest.prequest_no')
            ->where(DB::raw('YEAR(dtm_porder)'), '=',  2022)
            ->get();
        
        foreach($po_and_pr as $pr){
            if($request->ppb_pr_id == $po_and_pr){
                $data_header->ppb_po_id = $pr->porder_id;
            }
        }

        $data_header->ppb_for_project = $request->ppb_for_project;
        $data_header->ppb_location = $request->ppb_location;
        $data_header->ppb_dept_req = $request->ppb_dept_req;
        $data_header->ppb_schedule = $request->ppb_schedule;
        $data_header->ppb_instruction = $request->ppb_instruction;
        $data_header->ppb_notes = $request->ppb_notes;
        $data_header->ppb_propose_name = $request->ppb_propose_name;
        $data_header->ppb_propose_pos = $request->ppb_propose_pos;
        $data_header->ppb_propose_date = $request->ppb_propose_date;
        $data_header->ppb_approved_name = $request->ppb_approved_name;
        $data_header->ppb_approved_pos = $request->ppb_approved_pos;
        $data_header->ppb_approved_date = $request->ppb_approved_date;
        $data_header->ppb_user_name = $request->ppb_user_name;
        $data_header->ppb_user_pos = $request->ppb_user_pos;
        $data_header->ppb_user_date = $request->ppb_user_date;
        $data_header->ppb_remarks = $request->ppb_remarks;
        $data_header->insert_user = $request->insert_user;
        $data_header->insert_date = $request->insert_date;
        $data_header->edit_user = $request->edit_user;
        $data_header->edit_date = $request->edit_date;
        $data_header->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
