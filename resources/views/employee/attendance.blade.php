@extends('layouts.template')
@section('title', 'Attendance')

@section('nav')
@extends('layouts.navigation-bar-user')
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
        <form action="" id="check-in-loc">
            @csrf
            <h4 class="mb-3">Check In (Menuju Lokasi):</h4>
            <div class="row mb-3">
                <label for="check-in-date" class="col-md-2 col-form-label">Tanggal : </label>
                <div class="col-md-2">
                    <input type="date" class="form-control" name="check-in-date" id="check-in-date" readonly value="{{$today}}">
                </div>
                <label for="check-in-hour" class="col-md-1 col-form-label">Jam : </label>
                <div class="col-md-2">
                    <input type="time" class="form-control" name="check-in-hour" id="check-in-hour" readonly value="{{$now}}">
                </div>
                <div class="col-md-2">
                    <select class="form-select" name="check-in-timezone" id="check-in-timezone">
                        <option selected value="Asia/Jakarta">WIB</option>
                        <option value="Asia/Ujung_Pandang">WITA</option>
                        <option value="Asia/Jayapura">WIT</option>
                    </select>
                </div>
            </div>
            <input type="hidden" id="check-in-location" value="">
            <div class="row mb-3">
                <label for="check-in-description" class="col-md-2 col-form-label">Keterangan : </label>
                <div class="col-md-5">
                    <input type="description" class="form-control" name="check-in-description" id="check-in-description">
                </div>
                {{-- <input type="hidden" value="{{$user->emp_id}}"> --}}
                <button type="submit" id="check-in-loc-btn" class="btn btn-success col-md-2" onclick="toggleFormElements(true)">Check In</button>
            </div>
        </form>
        <form action="" id="check-out-loc">
            @csrf
            <h4 class="mb-3">Check Out (Tiba di Lokasi):</h4>
            <div class="row mb-3">
                <label for="check-out-date" class="col-md-2 col-form-label">Tanggal : </label>
                <div class="col-md-2">
                    <input type="date" class="form-control" name="check-out-date" id="check-out-date" readonly value="{{$today}}">
                </div>
                <label for="check-out-hour" class="col-md-1 col-form-label">Jam : </label>
                <div class="col-md-2">
                    <input type="time" class="form-control" name="check-out-hour" id="check-out-hour" readonly value="{{$now}}">
                </div>
                <div class="col-md-2">
                    <select class="form-select" name="check-out-timezone" id="check-out-timezone" disabled>
                        <option selected value="Asia/Jakarta">WIB</option>
                        <option value="Asia/Ujung_Pandang">WITA</option>
                        <option value="Asia/Jayapura">WIT</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="check-out-description" class="col-md-2 col-form-label">Keterangan : </label>
                <div class="col-md-5">
                    <input type="description" class="form-control" name="check-out-description" id="check-out-description" disabled>
                </div>
                <button type="submit" class="btn btn-danger col-md-2" disabled>Check Out</button>
            </div>
        </form>
    </div>
    <div class="container mt-5">
        <h2 class="my-4">Absen Pekerjaan</h2>
        <form action="">
            @csrf
            <h4 class="mb-3">Check In :</h4>
            <div class="row mb-3">
                <label for="check-in-hour" class="col-md-2 col-form-label">Jam : </label>
                <div class="col-md-2">
                    <input type="time" class="form-control" name="check-in-hour" id="check-in-hour" readonly value="{{$now}}">
                </div>
                <div class="col-md-2">
                    <select class="form-select" name="check-in-timezone" id="check-in-timezone">
                        <option selected value="Asia/Jakarta">WIB</option>
                        <option value="Asia/Ujung_Pandang">WITA</option>
                        <option value="Asia/Jayapura">WIT</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="check-in-description" class="col-md-2 col-form-label">Keterangan : </label>
                <div class="col-md-5">
                    <input type="description" class="form-control" name="check-in-description" id="check-in-description">
                </div>
                <button type="submit" class="btn btn-success col-md-2">Check In</button>
            </div>
        </form>
        <form action="">
            @csrf
            <h4 class="mb-3">Check Out  :</h4>
            <div class="row mb-3">
                <label for="check-out-hour" class="col-md-2 col-form-label">Jam : </label>
                <div class="col-md-2">
                    <input type="time" class="form-control" name="check-out-hour" id="check-out-hour" readonly value="{{$now}}">
                </div>
                <div class="col-md-2">
                    <select class="form-select" name="check-out-timezone" id="check-out-timezone">
                        <option selected value="Asia/Jakarta">WIB</option>
                        <option value="Asia/Ujung_Pandang">WITA</option>
                        <option value="Asia/Jayapura">WIT</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="check-out-description" class="col-md-2 col-form-label">Keterangan : </label>
                <div class="col-md-5">
                    <input type="description" class="form-control" name="check-out-description" id="check-out-description">
                </div>
                <button type="submit" class="btn btn-danger col-md-2">Check Out</button>
            </div>
        </form>
        <button class="btn btn-dark mt-4">Pekerjaan Baru</button>
    </div>
@endsection
