@extends('layouts.template')
@section('title', 'Dashboard')

@section('nav')
@extends('layouts.navigation-bar-user')
@section('content')
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
            <span class="me-5 pe-5"><span class="bg-success border border-light rounded-circle" style="width:10px; height:10px"></span>Online</span>
          </p>
        </div>
      </div>
    </div>
@endsection