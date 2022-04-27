@extends('layouts.template')
@section('title', 'Leave Early History')

@section('nav')
@extends('layouts.navigation-bar-admin')
@section('content')
    <div class="container" style="background-color: #bff5f3">
        <h1 class="text-center pt-5" style="font-family: 'Montserrat', sans-serif;font-weight: 800">ATTENDANCE HISTORY</h1>
        <h1 class="text-center pb-5" style="font-family: 'Montserrat', sans-serif;font-weight: 800">"LEAVE EARLIER"</h1>
    </div>
    <div class="container mt-5 border border-2 border-dark">
        <table id="leaveearly" class="table table-info table-striped">
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
                <tr>
                    <th scope="row"></th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection