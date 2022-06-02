@extends('layouts.template')
@section('title', 'Employee List')

@section('css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inria+Serif:wght@700&family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
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
            <p class="fw-bold text-dark mb-3">General Information : </p>
            <p class="ms-4 text-dark"><span style="font-weight: 500">First Name : </span>emp_first_name</p> 
            <p class="ms-4 text-dark"><span style="font-weight: 500">Middle Name : </span>emp_middle_name</p>
            <p class="ms-4 text-dark"><span style="font-weight: 500">Last Name : </span>emp_last_name</p>
            <p class="ms-4 text-dark"><span style="font-weight: 500">Birth Date : </span>emp_birth_date</p>
            <p class="fw-bold text-dark mb-3">Contact Information : </p>
            <p class="ms-4 text-dark"><span style="font-weight: 500">Contact : </span>emp_phone_number</p> 
            <p class="fw-bold text-dark mb-3">Employee Information : </p>
            <p class="ms-4 text-dark"><span style="font-weight: 500">Department : </span>emp_department</p> 
            <p class="ms-4 text-dark"><span style="font-weight: 500">Division : </span>emp_division</p>
            <p class="ms-4 text-dark"><span style="font-weight: 500">Position : </span>emp_position</p>
            <p class="ms-4 text-dark"><span style="font-weight: 500">Leader : </span>emp_coach</p>
            <p class="ms-4 text-dark"><span style="font-weight: 500">Manager : </span>emp_manager</p>
        </div>
        <div class="col-sm-4">

        </div>
    </div>
</div>

@endsection