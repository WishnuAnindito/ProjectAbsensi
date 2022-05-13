@extends('layouts.template')
@section('title', 'Leader Dashboard')

@section('nav')
@extends('layouts.navigation-bar-leader')
@section('content')
    <h1 class="text-center my-5">CREATE NEW TASK</h1>
    <div class="container">
        <form action="" method="POST">    
            <div class="row mb-3">
                <div class="col">
                    <div class="row">
                        <label for="date" class="col-sm-1 control-form-label">
                            <i class="fa-solid fa-calendar-days fa-2x"></i>
                        </label>
                        <div class="col-sm-11">
                            <input class="form-control" type="date" name="date" id="date">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="row">
                        <label for="time_start" class="col-sm-1 control-form-label">
                            <i class="fa-solid fa-user-clock fa-2x"></i>
                        </label>
                        <div class="col-sm-11">
                            <input class="form-control" type="time" name="time_start" id="time_start">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="row mb-3">
                        <label for="assign_to" class="col-sm-1 control-form-label">
                            <i class="fa-solid fa-user fa-2x"></i>
                        </label>
                        <div class="col-sm-11">
                            <select class="form-select" name="assign_to" id="assign_to">
                                <option selected disabled></option>
                                <option value="">nama</option>
                                <option value="">nama2</option>
                                <option value="">nama3</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="task_name" class="col-sm-1 control-form-label">
                            <i class="fa-solid fa-list-check fa-2x"></i>
                        </label>
                        <div class="col-sm-11">
                            <input class="form-control" type="text" name="task_name" id="task_name">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="address" class="col-sm-1 control-form-label">
                            <i class="fa-solid fa-house-chimney fa-2x"></i>
                        </label>
                        <div class="col-sm-11">
                            <input class="form-control" type="text" name="address" id="address">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="assign_to" class="col-sm-1 control-form-label">
                            <i class="fa-solid fa-city fa-2x"></i>
                        </label>
                        <div class="col-sm-11">
                            <select class="form-select"name="" id="">
                                <option selected disabled></option>
                                <option value="">kota1</option>
                                <option value="">kota2</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <img src="{{url('storage/images/vector.png')}}" alt="">
                </div>
            </div>
            <div class="row mb-5">
                <div class="col">
                    <div class="row">
                        <label for="assign_to" class="col-sm-1 control-form-label">
                            <i class="fa-solid fa-earth-asia fa-2x"></i>
                        </label>
                        <div class="col-sm-11">
                            <select class="form-select" name="" id="">
                                <option selected disabled></option>
                                <option value="">WIB</option>
                                <option value="">WITA</option>
                                <option value="">WIT</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="row">
                        <label for="time_end" class="col-sm-1 control-form-label">
                            <i class="fa-solid fa-user-clock fa-2x"></i>
                        </label>
                        <div class="col-sm-11">
                            <input class="form-control" type="time" name="time_end" id="time_end">
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-center">
                <button type="submit" class="btn btn-success text-white">
                    Create Task
                </button>
            </div>
        </form>
    </div>
@endsection