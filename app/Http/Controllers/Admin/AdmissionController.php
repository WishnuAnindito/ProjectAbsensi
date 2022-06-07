<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Update\CheckInRequest as UpdateCheckInRequest;
use App\Http\Requests\Update\CheckOutRequest as UpdateCheckOutRequest;
use App\Http\Requests\Update\EmployeeRequest as UpdateEmployeeRequest;
use App\Models\AbsenIn;
use App\Models\AbsenOut;

class AdmissionController extends Controller
{
    // Hanya untuk CRUD semua table
    
    // employee table
    public function employeeUpdateData(UpdateEmployeeRequest $request,$emp_id){

    }

    // Abs_in Table
    public function checkInUpdateData(UpdateCheckInRequest $request, $abs_in_id){
        $request->validated();
        $absenIn = new AbsenIn();
        $update = $absenIn->updateData($request,$abs_in_id);
        if($update){
            return redirect()->back()->with('Success', 'Data has been Updated');
        }else{
            return redirect()->back()->with('Failed', 'Fail to Update Data');
        }
    }

    public function checkInDeleteData($abs_in_id){
        $absenIn = new AbsenIn();
        $delete = $absenIn->deleteData($abs_in_id);
        if($delete){
            return redirect()->back()->with('Success', 'Data has been Deleted');
        }else{
            return redirect()->back()->with('Failed', 'Fail to Delete Data');
        }
    }

    // Abs_out Table
    public function checkOutUpdateData(UpdateCheckOutRequest $request, $abs_out_id){
        $request->validated();
        $absenOut = new AbsenOut();
        $update = $absenOut->updateData($request,$abs_out_id);
        if($update){
            return redirect()->back()->with('Success', 'Data has been Updated');
        }else{
            return redirect()->back()->with('Failed', 'Fail to Update Data');
        }
    }

    public function checkOutDeleteData($abs_out_id){
        $absenOut = new AbsenOut();
        $delete = $absenOut->deleteData($abs_out_id);
        if($delete){
            return redirect()->back()->with('Success', 'Data has been Deleted');
        }else{
            return redirect()->back()->with('Failed', 'Fail to Delete Data');
        }
    }
}
