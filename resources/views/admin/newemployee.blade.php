@extends('layouts.template')
@section('title', 'Add Employee')

@section('nav')
@extends('layouts.navigation-bar-admin')
@section('content')
    <h1 class="ms-4 my-5">Create New Employee</h1>
    <div class="container">
        <form action="" method="POST">
            @csrf
            <div class="row mb-3">
                <div class="col-sm-3">   
                    <label for="emp_first_name" class="form-label">First Name : </label>
                    <input type="text" class="form-control" name="emp_first_name" id="emp_first_name">
                </div>
                <div class="col-sm-3">   
                    <label for="emp_last_name" class="form-label">Last Name : </label>
                    <input type="text" class="form-control" name="emp_last_name" id="emp_last_name">
                </div>
                <div class="col-sm-3">   
                    <label for="username" class="form-label">Username : </label>
                    <input type="text" class="form-control" name="username" id="username">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3">
                    <label for="emp_birth_date" class="form-label">Birth Date : </label>
                    <input type="date" class="form-control" name="emp_birth_date" id="emp_birth_date">
                </div>
                <div class="col-sm-3">
                    <label for="emp_phone" class="form-label">Phone Number : </label>
                    <input type="text" class="form-control" name="emp_phone" id="emp_phone">
                </div>
                <div class="col-sm-3">
                    <label for="hired_date" class="form-label">Hired Date : </label>
                    <input type="date" class="form-control" name="hired_date" id="hired_date">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-3">
                    <label for="emp_department" class="form-label">Department : </label>
                    <select name="emp_department" id="emp_department" class="form-select">
                        <option selected disabled></option>
                        @foreach ($departments as $department)
                        <option value="{{$department->dept_id}}">{{$department->dept_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3">
                    <label for="emp_division" class="form-label">Division : </label>
                    <select name="emp_division" id="emp_division" class="form-select">
                        <option selected disabled></option>
                        @foreach ($divisions as $division)
                            <option value="{{$division->division_id}}">{{$division->division_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3">
                    <label for="emp_position" class="form-label">Position : </label>
                    <select name="emp_position" id="emp_position" class="form-select">
                        <option selected disabled></option>
                        @foreach ($positions as $position)
                            <option value="{{$position->pos_id}}">{{$position->pos_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="emp_address" class="form-label">Address : </label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="emp_address" id="emp_address">
                </div>
            </div>
            <div class="row mb-3">
                <label for="emp_email_office" class="form-label">Email : </label>
                <div class="col-sm-9">
                    <input type="email" class="form-control" name="emp_email_office" id="emp_email_office">
                </div>
            </div>
            <div class="row mb-3">
                <label for="user_pass" class="form-label">Password : </label>
                <div class="col-sm-9">
                    <input type="password" class="form-control" name="user_pass" id="user_pass">
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-center">
                <button type="submit" class="btn btn-success">Create New Employee</button>
            </div>
        </form>
    </div>
@endsection