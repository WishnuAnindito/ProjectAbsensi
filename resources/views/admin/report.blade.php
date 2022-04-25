@extends('layouts.template')
@section('title', 'Employee List')

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
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email Address</th>
                    <th scope="col">Telephone Number</th>
                    <th scope="col">Position</th>
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