@extends('layouts.template')
@section('title', 'Attendance')

@section('content')
    <div class="container">
        <h2 class="mt-4 mb-5">Attendance</h2>
        <div class="row mb-3">
            <label for="name" class="col-md-2 col-form-label">Nama Teknisi : </label>
            <div class="col-md-3">
                <input type="text" class="form-control" name="name" id="name" readonly value="{{--$employee->firstname.' '.$employee->middlename.' '.$employee->lastname--}}">
            </div>
        </div>
        <div class="row mb-3">
            <label for="hours" class="col-md-2 col-form-label">Week of Hours : </label>
            <div class="col-md-1 d-flex">
                <input type="number" class="form-control" name="hours" id="hours" readonly value="{{--$employee->attendance->total_hours--}}">
                <span class="h4 my-auto">/40 </span>
            </div>
        </div>
        <div class="row mb-3">
            <label for="startdate" class="col-md-2 col-form-label">Tanggal : </label>
            <div class="col-md-2">
                <input type="date" class="form-control" name="startdate" id="startdate" readonly value="{{$today}}">
            </div>
        </div>
        <div class="row mb-3">
            <label for="enddate" class="col-md-2 col-form-label">Sampai : </label>
            <div class="col-md-2">
                <input type="date" class="form-control" name="enddate" id="enddate" readonly value="{{$today}}">
            </div>
        </div>
        <h2 class="my-4">Absen Harian</h2>
        <div class="row mb-3">
            <label for="enddate" class="col-md-2 col-form-label">Sampai : </label>
            <div class="col-md-2">
                <input type="date" class="form-control" name="enddate" id="enddate" readonly value="{{$today}}">
            </div>
        </div>
    </div>
@endsection