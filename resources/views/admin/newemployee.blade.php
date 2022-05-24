@extends('layouts.template')
@section('title', 'Add Employee')

@section('nav')
@extends('layouts.navigation-bar-admin')
@section('content')
    <h1 class="text-center my-5">Add New Employee</h1>
    <div class="container">
        <form action="">
            @csrf
            <div class="row mb-3">
                <label for="name" class="col-sm-2 control-label">Full Name : </label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="name" id="name">
                </div>
            </div>
            <div class="row mb-3">
                <label for="department" class="col-sm-2 control-label">Department : </label>
                <div class="col-sm-4">
                    <select name="department" id="department" class="form-select">
                        <option selected disabled></option>
                        @foreach ($departments as $department)
                            <option value="{{$department->dept_id}}">{{$department->dept_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="division" class="col-sm-2 control-label">Division : </label>
                <div class="col-sm-4">
                    <select name="division" id="division" class="form-select">
                        <option selected disabled></option>
                        @foreach ($divisions as $division)
                            <option value="{{$division->division_id}}">{{$division->division_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="position" class="col-sm-2 control-label">Position : </label>
                <div class="col-sm-4">
                    <select name="position" id="position" class="form-select">
                        <option selected disabled></option>
                        @foreach ($positions as $position)
                            <option value="{{$position->pos_id}}">{{$position->pos_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>
    </div>
@endsection