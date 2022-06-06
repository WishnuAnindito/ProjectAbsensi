@extends('layouts.template')
@section('title', 'Attendance Details')

@section('css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inria+Serif:wght@700&family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        p{
            margin:0
        }
        body{
            overflow: hidden;
        }
    </style>
@endsection

@section('nav')
@extends('layouts.navigation-bar-admin')
@section('content')
<div class="container" style="font-family: 'Inter', sans-serif;">
        <h1 class="fw-bold mt-5 mb-4 ms-4"><u>Attendance Details</u></h1>
        <div class="row">
            <div class="col ms-5">
                <p class="fw-bold text-dark">Employee Information :</p>
                <p class="ms-5 text-dark"><span style="font-weight: 500">Department : </span>emp_department</p> 
                <p class="ms-5 text-dark"><span style="font-weight: 500">Division : </span>emp_division</p>
                <p class="ms-5 text-dark"><span style="font-weight: 500">Position : </span>emp_position</p>
                <p class="ms-5 text-dark"><span style="font-weight: 500">Leader : </span>emp_coach</p>
                <p class="ms-5 text-dark mb-3"><span style="font-weight: 500">Manager : </span>emp_manager</p>
                <p class="fw-bold text-dark">Task Information :</p>
                <p class="ms-5 text-dark"><span style="font-weight: 500">Task Name : </span>task_name</p>
                <p class="ms-5 text-dark"><span style="font-weight: 500">Task Assign By : </span>task_assign_by</p>
                <p class="ms-5 text-dark"><span style="font-weight: 500">Task Start Time :</span>task_start_time</p>
                <p class="ms-5 text-dark"><span style="font-weight: 500">Task End Time :</span>task_end_time</p>
                <p class="ms-5 text-dark"><span style="font-weight: 500">Task Address :</span>task_address</p>
                <p class="ms-5 text-dark"><span style="font-weight: 500">Status :</span>task_status</p>
            </div>
            <div class="col">
                <p class="fw-bold text-dark">Check In Information :</p>
                <p class="ms-5 text-dark"><span style="font-weight: 500">Absen Time : </span>abs_in_time</p> 
                <p class="ms-5 text-dark"><span style="font-weight: 500">Status : </span>status_check_in</p>
                <p class="ms-5 text-dark"><span style="font-weight: 500">Early By : </span>-</p>
                <p class="ms-5 text-dark"><span style="font-weight: 500">(or) Late By : </span>-</p>
                <p class="ms-5 text-dark mb-3"><span style="font-weight: 500">Summary : </span>abs_reason</p>
                <p class="fw-bold text-dark">Check Out Information :</p>
                <p class="ms-5 text-dark"><span style="font-weight: 500">Absen Time : </span>abs_out_time</p>
                <p class="ms-5 text-dark"><span style="font-weight: 500">Status : </span>status_check_out</p>
                <p class="ms-5 text-dark"><span style="font-weight: 500">Early By : </span>-</p>
                <p class="ms-5 text-dark"><span style="font-weight: 500">(or) Late By : </span>-</p>
                <p class="ms-5 text-dark"><span style="font-weight: 500">Summary : </span>abs_reason</p>
            </div>
        </div>
        <div class="row"  style="height:50%">
            <div class="col d-flex align-items-center justify-content-center">
                <a href="" class="btn btn-secondary px-5 mx-5" style="border-radius: 16px">Edit</a>
                <a href="" class="btn btn-danger px-5 mx-5" style="border-radius: 16px">Delete</a>
            </div>
            <div class="col text-end" style="height:50%">
                <img class="img-responsive" src="{{Storage::url('images/vectorattendancedetails.png')}}" alt="" width="300" height="200">
            </div>
        </div>
    </div>
@endsection