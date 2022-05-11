@extends('layouts.template')
@section('title', 'Employee List')

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.css"/>
@endsection

@section('nav')
@extends('layouts.navigation-bar-leader')
@section('content')
    <div class="container " style="background-color: #bff5f3">
        <h1 class="text-center py-5" style="font-family: 'Montserrat', sans-serif;font-weight: 800">EMPLOYEE LIST</h1>
    </div>
    <div class="container mt-5 py-3 border border-2 border-dark">
        <table id="employeelist" class="table table-info table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Department</th>
                    <th scope="col">Division</th>
                    <th scope="col">Position</th>
                    <th scope="col">Coach</th>
                    <th scope="col">Manager</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    <tr>
                        <th scope="row">{{$employee->emp_id}}</th>
                        <td>{{$employee->emp_full_name}}</td>
                        <td>{{$employee->dept_name}}</td>
                        <td>{{$employee->division_name}}</td>
                        <td>{{$employee->pos_name}}</td>
                        <td>{{$employee->coach}}</td>
                        <td>{{$employee->manager}}</td>
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
        $('#employeelist').DataTable();
        } );
    </script>
@endsection