@extends('layouts.template')
@section('title', 'Leader Dashboard')

@section('nav')
@extends('layouts.navigation-bar-leader')
@section('content')
  <div class="container mt-5">
    <div class="row">
      <div class="col-sm-4 text-white">
        <div class="card bg-secondary" style="height:100%">
          <div class="row ms-1 my-auto">
            <div class="col-sm-2 card-body">
              <i class="fa-solid fa-user-group fa-5x"></i>
            </div>
            <div class="col-sm-7 card-body text-center">
              <h3 class="card-title">{{$data[0]}}</h3>
              <p class="card-text text-white">Employee Total</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-4 text-white">
        <div class="card bg-info" style="height:100%">
          <div class="row ms-1">
            <div class="col-sm-2 card-body">
              <i class="fa-solid fa-clipboard-list fa-5x"></i>
              {{-- <i class="fa-solid fa-clock fa-5x"></i> --}}
            </div>
            <div class="col-sm-7 card-body text-center">
              <h4 class="card-title">{{$data[2]}}</h4>
              <p class="card-text text-white">Daily Task Total</p>
            </div>
          </div>
        </div>  
      </div>
      <div class="col-sm-4 text-white">
        <div class="card bg-success" style="height:100%">
          <div class="row ms-1">
            <div class="col-sm-2 card-body">
              <i class="fa-solid fa-chart-pie fa-5x"></i>
            </div>
            <div class="col-sm-7 card-body text-center">
              <h3 class="card-title">{{$data[1]}}%</h3>
              <p class="card-text text-white">On Time Percentage</p>
            </div>  
          </div>
        </div>  
      </div>
    </div>
  </div>
  <hr class="mt-5 mb-1">
  <div class="container">
    <div class="fs-2 text-center" id="date"></div>
    <div class="fs-2 text-center" id="time"></div>
  </div>
  <hr class="mt-1 mb-2">
  <div class="overflow-hidden position-absolute pt-2" style="height:100%; width:100%; box-sizing:border-box;"> 
  </div>
  <div class="container border border-3 border-dark position-relative px-5 overflow-auto">
    <h3 class="text-center"><u>Technician Attendance</u></h3>
    @foreach ($data[3] as $employee)
      <div class="row border border-4 border-dark mb-3" style="background: #A3ECE8">
        <div class="col-sm-2">
          <img src="" alt="" class="rounded-circle">
        </div>
        <div class="col-sm-6">
          <h5 class="mt-2">{{$employee->emp_full_name}}</h5>
          <hr>
          <h5>{{$employee->pos_name}}</h5>
        </div>
        <div class="col-sm-2">
          <h5 class="text-center mt-4" style="color: #F8990B">task code</h5>
        </div>
        <div class="col-sm-2">
          <h5 class="text-center mt-4" style="color: #128510">ontime/late</h5>
        </div>
      </div>
    @endforeach
    {{-- @foreach ($data[3] as $employee)
    @endforeach --}}
    
  </div>
@endsection