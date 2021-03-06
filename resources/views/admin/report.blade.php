@extends('layouts.template')
@section('title', 'Weekly Attendance Report')

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.css"/>
@endsection

@section('nav')
@extends('layouts.navigation-bar-admin')
@section('content')
    <div class="container py-5" style="background-color: #bff5f3">
        <h1 class="text-center" style="font-family: 'Montserrat', sans-serif;font-weight: 800">ATTENDANCE WEEKLY REPORT</h1>
        <button class="btn btn-primary float-end"><i class="fa-solid fa-file-pdf"></i> GENERATE PDF</button>
    </div>
    <div class="container mt-5 border border-2 border-dark">
        <table id="report" class="table table-info table-striped">
            <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Name</th>
                    <th scope="col">Task Name</th>
                    <th scope="col">Check In Status</th>
                    <th scope="col">Check Out Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($report as $rep)
                    <tr>
                        <th scope="row">{{$rep->abs_date}}</th>
                        <td><{{$rep->emp_full_name}}/td>
                        <td>{{$rep->task_name}}</td>
                        <td>{{$rep->status_check_in}}</td>
                        <td>{{$rep->status_check_out}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.js"></script>
    <script type="text/javascript">
        $(document).ready( function () {
        $('#report').DataTable();
        } );
    </script>
@endsection