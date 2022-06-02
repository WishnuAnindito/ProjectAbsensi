@extends('layouts.template')
@section('title', 'Employee List')

@section('css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inria+Serif:wght@700&family=Inter:wght@700&display=swap" rel="stylesheet">
@endsection

@section('nav')
@extends('layouts.navigation-bar-admin')
@section('content')
<h1 class="ms-3 mt-4 mb-3" style="font-family: 'Inter', sans-serif;">EMPLOYEES</h1>
    <div class="container">
        <div class="row">
            <div class="col-sm-10">
                <form action="">
                    <input type="search" class="form-control" name="search_employee" id="search_employee" placeholder="Find Something">
                </form>
            </div>
            <div class="col-sm-2">
                <a href="" class="btn text-dark" style="background-color:#5EE95B">+ New</a>
            </div>
        </div>
        <div class="row mb-3">
            <div class="dropdown col-auto ms-2">
                <button class="btn btn-secondary dropdown-toggle pe-4" type="button" id="titleDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 16px">
                  Job Title
                </button>
                <ul class="dropdown-menu" aria-labelledby="titleDropdown">
                    {{-- @foreach ($titles as $title)
                        <li><a class="dropdown-item" href="#"></a></li>    
                    @endforeach --}}
                </ul>
              </div>
            <div class="dropdown col-auto">
                <button class="btn btn-secondary dropdown-toggle pe-4" type="button" id="departmentDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 16px">
                  Department
                </button>
                <ul class="dropdown-menu" aria-labelledby="departmentDropdown">
                    {{-- @foreach ($titles as $title)
                        <li><a class="dropdown-item" href="#"></a></li>    
                    @endforeach --}}
                </ul>
              </div>
        </div>
        <div class="row">
            <div class="col-sm-10">
                <h3 class="ms-3">1000 Employees</h3>
            </div>
            <div class="col-sm-2">
                <select class="pe-3" name="sort_by" id="sort_by">
                    <option selected disabled>Sort By</option>
                    <option value=""></option>
                </select>
            </div>
        </div>
        <div class="row">
            @for ($i = 0; $i < 50; $i++)
                <div class="col-sm-3 mb-4">
                    <a href="#">
                        <div class="card">
                            <img src="{{Storage::url('images/yugioh.png')}}" class="card-img-top" alt="">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">Emp_full_name</h5>
                                <p class="card-text">Title</p>
                                <p class="card-text">email</p>
                            </div>
                        </div>
                    </a>
                </div>    
            @endfor
        </div>
    </div>
@endsection
