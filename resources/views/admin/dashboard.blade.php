@extends('layouts.template')
@section('title', 'Admin Dashboard')

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.css"/>
@endsection

@section('nav')
@extends('layouts.navigation-bar-admin')
@section('content')
  {{-- {{dd($data)}} --}}
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
              <h4 class="card-title">{{$data[1]}}</h4>
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
              <h3 class="card-title">{{$data[2]}}%</h3>
              <p class="card-text text-white">On Time Percentage</p>
            </div>  
          </div>
        </div>  
      </div>
    </div>
  </div>
  <hr class="mt-5 mb-2">
  {{-- <div class="container">
    <div class="fs-2 text-center" id="date"></div>
    <div class="fs-2 text-center" id="time"></div>
  </div> --}}
  {{-- <hr class="mt-1 mb-2"> --}}
  <h3 class="ms-2">Attendance Logs</h3>
  <div class="container position-relative px-5 overflow-auto">
    <table class="table mt-3">
      <thead>
        <tr>
          <th scope="col">Date</th>
          <th scope="col">Employee Name</th>
          <th scope="col">Check In Time</th>
          <th scope="col">Check Out Time</th>
          <th scope="col">Work Duration</th>
          <th scope="col">Overtime</th>
          <th scope="col">Status</th>
          <th scope="col">Review</th>
        </tr>
      </thead>
      <tbody>
        {{-- @foreach ($data[3] as $employee)  
          <tr>
            <th scope="row">{{$employee->abs_date}}</th>
            <th>{{$employee->emp_full_name}}</th>
            <th>{{$employee->check_in_time}}</th>
            <th>{{$employee->check_out_time}}</th>
            <th>{{$employee->work_duration}}</th>
            <th>{{$employee->overtime}}</th>
            <th>{{$employee->status}}</th>
            <th><a href="{{route('review-employees', [$employee->emp_id])}}">Review</a></th>
          </tr>
        @endforeach --}}
      </tbody>
    </table>
  </div>
@endsection

@section('script')
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.js"></script>
    <script type="text/javascript">
        $(document).ready( function () {
        $('#ontime').DataTable({responsive: true});
        } );
    </script>
@endsection