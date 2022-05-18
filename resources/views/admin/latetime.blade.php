@extends('layouts.template')
@section('title', 'Late Time History')

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.css"/>
@endsection

@section('nav')
@extends('layouts.navigation-bar-admin')
@section('content')
    <div class="container" style="background-color: #bff5f3">
        <h1 class="text-center pt-5" style="font-family: 'Montserrat', sans-serif;font-weight: 800">ATTENDANCE HISTORY</h1>
        <h1 class="text-center pb-5" style="font-family: 'Montserrat', sans-serif;font-weight: 800">"LATE TIME"</h1>
    </div>
    <div class="container mt-5 border border-2 border-dark">
        <table id="latetime" class="table table-info table-striped">
            <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Name</th>
                    <th scope="col">Time</th>
                    <th scope="col">Address</th>
                    <th scope="col">Zone Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($latetime as $late)
                    <tr>
                        <th scope="row">{{$late->abs_date}}</th>
                        <td>{{$late->emp_full_name}}</td>
                        <td>{{$late->abs_time}}</td>
                        <td></td>
                        <td></td>
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
        $('#latetime').DataTable();
        } );
    </script>
@endsection