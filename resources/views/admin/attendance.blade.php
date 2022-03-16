@extends('layouts.template')
@section('title', 'Attendance')

@section('content')
<div class="container">
    <h2 class="mt-4">Monthly Attendance Report</h2>
    <table class="table table-hover table-bordered">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Employee Name</th>
          <th scope="col">Attendance Time</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($attendances as $attendance)
            <tr>
                <th scope="row">{{$attendance->id}}</th>
                <td>{{$attendance->user->name}}</td>
                <td>{{$attendance->attendance_time}}</td>
            </tr>  
          @endforeach
      </tbody>
    </table>
</div>
@endsection