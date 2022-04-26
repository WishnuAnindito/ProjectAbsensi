@extends('layouts.template')
@section('title', 'Dashboard')

@section('nav')
@extends('layouts.navigation-bar-user')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-4 text-white">
                <div class="card bg-secondary" style="height:100%">
                  <div class="row ms-1 my-auto">
                    <div class="col-sm-2 card-body">
                        <i class="fa-solid fa-clock-rotate-left fa-5x"></i>
                    </div>
                    <div class="col-sm-7 card-body text-center">
                      <h2 class="card-title">Attendance History</h2>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 text-white">
                <div class="card bg-info" style="height:100%">
                  <div class="row ms-1">
                    <div class="col-sm-2 card-body">
                        <i class="fa-solid fa-stopwatch fa-5x"></i>
                    </div>
                    <div class="col-sm-7 card-body text-center">
                      <h3 class="card-title">0/40</h3>
                      <h3 class="card-text text-white">Work Hours</h3>
                    </div>
                  </div>
                </div>  
              </div>
              <div class="col-sm-4 text-white">
                <div class="card bg-success" style="height:100%">
                  <div class="row ms-1">
                    <div class="col-sm-2 card-body">
                        <i class="fa-solid fa-calendar-days fa-5x"></i>
                    </div>
                    <div class="col-sm-7 card-body text-center">
                      <h2 class="card-title text-bold">Weekly Attendance</h2>
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
        <div class="container">
            <div class="col-sm-4">
                <img src="" alt="">
                <hr>
                <h2>Lorem ipsum</h2>
                <h4>VSAT Technician Service Point Tangerang Selatan</h4>
                <button>logout</button>
            </div>
            <div class="col-sm-8">

            </div>
        </div>
@endsection