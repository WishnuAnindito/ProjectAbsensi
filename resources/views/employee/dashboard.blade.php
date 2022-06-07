@extends('layouts.template')
@section('title', 'Dashboard')

@section('css')
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inria+Serif:wght@700&family=Inter:wght@700&display=swap" rel="stylesheet">
  <style>
    .dot{
      height: 20px;
      width: 20px;
      background-color: #38FA18;
      border-radius: 50%;
      display: inline-block;
    }
  </style>
@endsection

@section('nav')
@extends('layouts.navigation-bar-user')
@section('content')
{{dd(Auth::user())}}
    <div class="container py-5" style="background-color: #C1D1D5">
      <div class="row">
        <div class="col-sm-3">
          <img class="rounded-circle" src="{{Storage::url('images/yugioh.png')}}" alt="">
        </div>
        <div class="col-sm-9">
          <h1>emp_full_name</h1>
          <p class="text-dark">emp_position&emsp;|&emsp;emp_phone_number&emsp;|&emsp;emp_email_office</p>
          <hr>
          <p class="fw-bold text-dark d-flex justify-content-between">
            <span class="ms-5 ps-5">Coach</span>
            <span>Manager</span>
            <span class="me-5 pe-5">Status</span>
          </p>
          <p class="text-dark d-flex justify-content-between">
            <span class="ms-5 ps-4">emp_coach</span>
            <span>emp_manager</span>
            <span class="me-5 pe-5"><span class="dot "></span> Online</span>
          </p>
        </div>
      </div>
    </div>
    <div class="container mt-5">
      <div class="row">
        @for ($i=0; $i<10; $i++)
          <div class="col-sm-5 ms-5 border border-dark mb-4">
            <div class="border border-dark mx-3 my-3" style="background-color:#C1D1D5">
              <p class="text-dark mt-3 ms-3" style="font-weight:600;">task_code : task_name</p>
            </div>
            <p class="text-dark ms-5"><span style="font-weight: 600">Start Time : </span>task_start_time</p>
            <p class="text-dark ms-5"><span style="font-weight: 600">End Time : </span>task_end_time</p>
            <p class="text-dark ms-5"><span style="font-weight: 600">Address : </span>task_address</p>
            <p class="text-dark ms-5"><span style="font-weight: 600">Status : </span>task_status</p>
            <div class="d-flex align-items-center justify-content-center">
              <button class="btn text-center text-white mb-2 px-4" style="background-color: #31C30C; border-radius: 16px;">Check In</button>
            </div>
          </div>  
        @endfor
      </div>
    </div>
@endsection