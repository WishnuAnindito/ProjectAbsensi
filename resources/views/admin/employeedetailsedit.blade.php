@extends('layouts.template')
@section('title', 'Employee Details')

@section('css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inria+Serif:wght@700&family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        p{margin:0}
    </style>
@endsection

@section('nav')
@extends('layouts.navigation-bar-admin')
@section('content')
<div class="container" style="font-family: 'Inter', sans-serif;">
    <h1 class="fw-bold ms-3 mt-4">Employee_full_name</h1>
    <h6 class="ms-4 mb-3" style="font-weight: 400">emp_email_office</h6>
    <div class="row">
        <div class="col-sm-3">
            <img class="ms-3" src="{{Storage::url('images/yugioh.png')}}" alt="">
        </div>
        <div class="col-sm-5">
            <p class="fw-bold text-dark mb-2">General Information : </p>
            <p class="ms-4 text-dark"><span style="font-weight: 500">First Name : </span>emp_first_name</p> 
            <p class="ms-4 text-dark"><span style="font-weight: 500">Middle Name : </span>emp_middle_name</p>
            <p class="ms-4 text-dark"><span style="font-weight: 500">Last Name : </span>emp_last_name</p>
            <p class="ms-4 text-dark"><span style="font-weight: 500">Birth Date : </span>emp_birth_date</p>
            <p class="fw-bold text-dark my-2">Contact Information : </p>
            <p class="ms-4 text-dark">
                <span style="font-weight: 500">Contact : </span>
                <input type="text" class="form-control" name="emp_phone_number" id="emp_phone_number" placeholder="emp_phone_number">
            </p>
            <p class="fw-bold text-dark my-2">Employee Information : </p>
            <p class="ms-4 text-dark">
                <span style="font-weight: 500">Department : </span>
                <select class="form-select" name="emp_department" id="emp_department">
                    <option value="" selected disabled>emp_department</option>
                </select>
            </p> 
            <p class="ms-4 text-dark">
                <span style="font-weight: 500">Division : </span>
                <select class="form-select" name="emp_division" id="emp_division">
                    <option value="" selected disabled>emp_division</option>
                </select>
            </p>
            <p class="ms-4 text-dark">
                <span style="font-weight: 500">Position : </span>
                <select class="form-select" name="emp_position" id="emp_position">
                    <option value="" selected disabled>emp_position</option>
                </select>
            </p>
            <p class="ms-4 text-dark">
                <span style="font-weight: 500">Leader : </span>
                <select class="form-select" name="emp_coach" id="emp_coach">
                    <option value="" selected disabled>emp_coach</option>
                </select>
            </p>
            <p class="ms-4 text-dark">
                <span style="font-weight: 500">Manager : </span>
                <select class="form-select" name="emp_manager" id="emp_manager">
                    <option value="" selected disabled>emp_manager</option>
                </select>
            </p>
            <p class="fw-bold text-dark my-2">Additional Information : </p>
            <p class="ms-4 text-dark"><span style="font-weight: 500">Attendance : </span>emp_total_attendance</p> 
            <p class="ms-4 text-dark"><span style="font-weight: 500">Daily Attendance : </span>emp_daily_attendance</p>
            <p class="ms-4 text-dark"><span style="font-weight: 500">Work Hour : </span>emp_work_hour</p>
        </div>
        <div class="col-sm-4">
            <div class="border border-dark text-center" style="background-color: #C1D1D5; width:40%">
                Action
            </div>
            <div class="border border-dark text-center" style="width:40%">
                <button type="submit" class="btn btn-primary my-2" style="border-radius:16px">Save Edited</button>
            </div>
        </div>
    </div>
</div>

@endsection