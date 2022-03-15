@extends('layouts.template')
@section('title', 'Dashboard')

@section('content')
  <div class="container">
    <h2 class="mb-4">Dashboard</h2>
    <div class="row">
      <div class="col-sm-3 text-white">
        <div class="card bg-secondary" style="height:100%">
          <div class="row ms-1">
            <div class="col-sm-4 card-body">
              <h3 class="card-title">21</h3>
              <p class="card-text text-white">Total Employees</p>
            </div>
            <div class="col-sm-4 card-body">
              <i class="fa-solid fa-user-group fa-5x"></i>
            </div>
            <h6 class="card-footer text-center">More Info</h6>
          </div>  
        </div>
      </div>
      <div class="col-sm-3 text-white">
        <div class="card bg-success" style="height:100%">
          <div class="row ms-1">
            <div class="col-sm-4 card-body">
              <h3 class="card-title">100%</h3>
              <p class="card-text text-white">On Time Percentage</p>
            </div>
            <div class="col-sm-4 card-body">
              <i class="fa-solid fa-chart-pie-simple"></i>
            </div>  
            <h6 class="card-footer text-center">More Info</h6>
          </div>
        </div>  
      </div>
      <div class="col-sm-3 text-white">
        <div class="card bg-warning" style="height:100%">
          <div class="row ms-1">
            <div class="col-sm-4 card-body">
              <h4 class="card-title">10</h4>
              <p class="card-text text-white">On Time Today</p>
            </div>
            <div class="col-sm-4 card-body fa-4x">
              <i class="fa-solid fa-clock"></i>
            </div>
            <h6 class="card-footer text-center mt-2">More Info</h6>
          </div>
        </div>  
      </div>
      <div class="col-sm-3 text-white">
        <div class="card bg-danger" style="height:100%">
          <div class="row ms-1">
            <div class="col-sm-4 card-body">
              <h4 class="card-title">11</h4>
              <p class="card-text text-white">Late Today</p>
            </div>
            <div class="col-sm-4 card-body">
              <i class="fa-solid fa-triangle-exclamation fa-5x"></i>
            </div>
            <h6 class="card-footer text-center mt-4">More Info</h6>
          </div>
        </div>  
      </div>
    </div>
  </div>
@endsection