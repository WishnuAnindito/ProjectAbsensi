@extends('layouts.template')
@section('title', 'Employee List')

@section('nav')
@extends('layouts.navigation-bar-admin')
@section('content')
    <div class="container" style="background-color: #bff5f3">
        <h1 class="text-center py-5" style="font-family: 'Montserrat', sans-serif;font-weight: 800">EMPLOYEE LIST</h1>
    </div>
    <div class="container mt-5 border border-2 border-dark">
        <table id="employeelist" class="table table-info table-striped">
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
                @foreach ($employees as $employee)
                    <tr>
                        <th scope="row">{{$employee->emp_id}}</th>
                        <td>{{$employee->emp_full_name}}</td>
                        <td>{{$employee->emp_email_office}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection