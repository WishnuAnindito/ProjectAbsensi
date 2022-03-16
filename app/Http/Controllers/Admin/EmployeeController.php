<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRecrutment;
use App\Models\Role;
use App\Models\Schedule;
use App\Models\User;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Menampilkan seluurh data karyawan
        return view('admin.employee')->with(['employees' => User::all(), 'schedules' => Schedule::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeRecrutment $request) //Menambah Karyawan Baru
    {
        
        $request->validate();

        $employee = new User;
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->password = bcrypt($request->password);
        $employee->phone = $request->phone;
        $employee->address = $request->address;
        $employee->schedule = $request->schedule;
        $employee->save();


        if ($request->schedule) {
            $schedule = Schedule::whereSlug($request->schedule)->first();
            $employee->schedules()->attach($schedule);
        }

        $role = Role::whereSlug('emp')->first();

        $employee->roles()->attach($role);

        return redirect()->route('employees.index')->with('success', 'Employee Has Been Created Successfully');
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
