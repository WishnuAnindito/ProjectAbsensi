@extends('layouts.template')
@section('title', 'My Task')

@section('css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inria+Serif:wght@700&family=Inter:wght@700&display=swap" rel="stylesheet">
    <style>
        p{
            margin:0;
        }
        .task{
            overflow-y: scroll;
            height: 600px;
            
        }
    </style>
@endsection

@section('nav')
@extends('layouts.navigation-bar-user')
@section('content')

    <div class="container">
        <h1 class="ms-4 my-5"><u>Weekly Task</u></h1>
        <div class="row">
            <div class="col-sm-3 mx-5 border border-dark task">
                <div class="row border border-dark d-flex mt-3 mb-4 mx-3 py-2" style="background-color: #C1D1D5">
                    <h4 class="m-0" style="width:80%">On This Week</h4>
                    <div class="bg-dark text-white text-center" style="width: 40px; height:30px">
                        10
                    </div>
                </div>
                @for ($i = 0; $i <10; $i++)
                    <div class="row mx-3 mb-3 position-relative" style="background-color: #D2E4EE; height: 150px;">
                        <p class="text-dark" style="font-weight: 600">task_code</p>
                        <p class="text-dark mb-5">task_name adalah ini itu dan segalanya</p>
                        <div class="float-end text-center position-absolute bottom-0 end-0 mb-2 me-2" style="background-color:#65CBF2; width:50%; border-radius:16px;">
                            <i class="fa-solid fa-clock text-white"></i> 30 Juni
                        </div>
                    </div>
                @endfor
            </div>
            <div class="col-sm-3 mx-5 border border-dark task">
                <div class="row border border-dark d-flex mt-3 mb-4 mx-3 py-2" style="background-color: #C1D1D5">
                    <h4 class="m-0" style="width:80%">Today</h4>
                    <div class="bg-dark text-white text-center" style="width: 40px; height:30px">
                        3
                    </div>
                </div>
                @for ($i = 0; $i < 2; $i++)
                    <div class="row mx-3 mb-3 position-relative" style="background-color: #D2E4EE; height: 150px;">
                        <p class="text-dark" style="font-weight: 600">task_code</p>
                        <p class="text-dark mb-5">task_name adalah ini itu dan segalanya</p>
                        <a href="#" class="btn btn-danger float-end text-center position-absolute bottom-0 end-0 mb-2 me-2 text-dark" style="width:50%; height:22%; border-radius:16px;">
                            Check Out
                        </a>
                    </div>
                    @endfor
                    <div class="row mx-3 mb-3 position-relative" style="background-color: #D2E4EE; height: 150px;">
                        <p class="text-dark" style="font-weight: 600">task_code</p>
                        <p class="text-dark mb-5">task_name adalah ini itu dan segalanya</p>
                        <a href="#" class="btn float-end align-items-center text-center position-absolute bottom-0 end-0 mb-2 me-2 text-dark" style="background-color: #31C30C; width:50%; height:22%; border-radius:16px;">
                            Check In
                        </a>
                    </div>
            </div>
            <div class="col-sm-3 mx-5 border border-dark task">
                <div class="row border border-dark d-flex mt-3 mb-4 mx-3 py-2" style="background-color: #C1D1D5">
                    <h4 class="m-0" style="width:80%">Complete</h4>
                    <div class="bg-dark text-white text-center" style="width: 40px; height:30px">
                        8
                    </div>
                </div>
                @for ($i = 0; $i < 4; $i++)
                    <div class="row mx-3 mb-3 position-relative" style="background-color: #D2E4EE; height: 150px;">
                        <p class="text-dark" style="font-weight: 600">task_code</p>
                        <p class="text-dark mb-5">task_name adalah ini itu dan segalanya</p>
                        <div class="float-end text-center position-absolute bottom-0 end-0 mb-2 me-2" style="background-color:#31C30C; width:50%; border-radius:16px;">
                            Approved
                        </div>
                    </div>
                @endfor
                @for ($i = 0; $i < 4; $i++)
                    <div class="row mx-3 mb-3 position-relative" style="background-color: #D2E4EE; height: 150px;">
                        <p class="text-dark" style="font-weight: 600">task_code</p>
                        <p class="text-dark mb-5">task_name adalah ini itu dan segalanya</p>
                        <div class="float-end text-center position-absolute bottom-0 end-0 mb-2 me-2" style="background-color:#D2F01B; width:50%; border-radius:16px;">
                            Waiting
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>

@endsection