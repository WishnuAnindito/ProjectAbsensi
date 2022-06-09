@extends('layouts.template')
@section('title', 'Profile')

@section('css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inria+Serif:wght@700&family=Inter:wght@700&display=swap" rel="stylesheet">
    <style>
        p{margin:0;}
    </style>
@endsection

@section('nav')
@extends('layouts.navigation-bar-user')
@section('content')

<div class="container mt-5" style="font-family: 'Inter', sans-serif;">
    <h1 class="ms-4">emp_full_name</h1>
    <p class="ms-4 mb-3">emp_email_office</p>
    <div class="row">
        <div class="col-sm-3">
            <img class="rounded ms-4" src="{{Storage::url('images/yugioh.png')}}" alt="">
        </div>
        <div class="col-sm-5">
            <p class="fw-bold text-dark mb-2">General Information : </p>
            <p class="ms-4 text-dark"><span style="font-weight: 500">First Name : </span>emp_first_name</p> 
            <p class="ms-4 text-dark"><span style="font-weight: 500">Middle Name : </span>emp_middle_name</p>
            <p class="ms-4 text-dark"><span style="font-weight: 500">Last Name : </span>emp_last_name</p>
            <p class="ms-4 text-dark"><span style="font-weight: 500">Birth Date : </span>emp_birth_date</p>
            <p class="fw-bold text-dark my-2">Contact Information : </p>
            <p class="ms-4 text-dark"><span style="font-weight: 500">Contact : </span>emp_phone_number</p> 
            <p class="fw-bold text-dark my-2">Employee Information : </p>
            <p class="ms-4 text-dark"><span style="font-weight: 500">Department : </span>emp_department</p> 
            <p class="ms-4 text-dark"><span style="font-weight: 500">Division : </span>emp_division</p>
            <p class="ms-4 text-dark"><span style="font-weight: 500">Position : </span>emp_position</p>
            <p class="ms-4 text-dark"><span style="font-weight: 500">Leader : </span>emp_coach</p>
            <p class="ms-4 text-dark"><span style="font-weight: 500">Manager : </span>emp_manager</p>
            <p class="fw-bold text-dark my-2">Additional Information : </p>
            <p class="ms-4 text-dark"><span style="font-weight: 500">Attendance : </span>emp_total_attendance</p> 
            <p class="ms-4 text-dark"><span style="font-weight: 500">Daily Attendance : </span>emp_daily_attendance</p>
            <p class="ms-4 text-dark"><span style="font-weight: 500">Work Hour : </span>emp_work_hour</p>
        </div>
        <div class="col-sm-4">
            <div class="border border-dark text-center" style="background-color: #C1D1D5; width:40%">
                Action
            </div>
            <div class="border border-dark text-center py-2" style="width:40%">
                <a href="" style="color: #0A3E65"><i class="fa-solid fa-pen-to-square"></i> Request Edit</a>
            </div>
        </div>
    </div>
</div>

@endsection