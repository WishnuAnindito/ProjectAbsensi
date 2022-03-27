<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>@yield('title')</title>
</head>
<body>
    {{-- @yield('content') --}}

    <div class="container">
        <form action="{{--route('header')--}}" class="row" method="POST">
            @csrf
            <h2 class="my-5">HEADER FORM</h2>
            <div class="col">
                <div class="row mb-3">
                    <label for="ppb_pr_id" class="col-md-4 col-form-label">No PR : </label>
                    <div class="col-md-7">
                        <select name="ppb_pr_id" id="ppb_pr_id" class="form-select">
                                <option selected disabled>Select One</option>
                                @foreach ($po_and_pr as $pr)
                                    <option value={{$pr->prequest_id}}>{{$pr->prequest_no}}</option>
                                @endforeach
                            </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="ppb_date" class="col-md-4 col-form-label">Date : </label>
                    <div class="col-md-5">
                        <input type="date" class="form-control" name="ppb_date" id="ppb_date">
                    </div>
                </div>
                <datalist id="for_project_datalist">
                    @foreach ($projects as $project)
                        <option value="{{$project->project_desc}}"></option>
                    @endforeach
                </datalist>
                <div class="row mb-3">
                    <label for="ppb_for_project" class="col-md-4 col-form-label">For Project : </label>
                    <div class="col-md-7">
                        <input type="text" name="ppb_for_project" id="ppb_for_project" class="form-control" list="for_project_datalist">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="ppb_location" class="col-md-4 col-form-label">Location : </label>
                    <div class="col-md-5">
                        @foreach ($location as $loc)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{$loc->location_id}}" id="ppb_location{{$loc->location_id}}">
                            <label class="form-check-label" for="ppb_location{{$loc->location_id}}">
                                {{$loc->location_name}}
                            </label>   
                        </div>
                        @endforeach    
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="ppb_dep_req" class="col-md-4 col-form-label">Department Requirement : </label>
                    <div class="col-md-5">
                        <select name="ppb_dep_req" id="ppb_dep_req" class="form-select">
                            @foreach ($department as $dept)
                                <option value="{{$dept->dept_id}}">{{$dept->dept_name}}</option>                            
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="ppb_schedule" class="col-md-4 col-form-label">Usage Schedule : </label>
                    <div class="col-md-5">
                        <input type="date" class="form-control" name="ppb_schedule" id="ppb_schedule">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="ppb_instruction" class="col-md-4 col-form-label">Special Instruction : </label>
                    <div class="col-md-7">
                        <textarea class="form-control" name="ppb_instruction" id="ppb_instruction"></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="ppb_notes" class="col-md-4 col-form-label">Note : </label>
                    <div class="col-md-7">
                        <textarea class="form-control" name="ppb_notes" id="ppb_notes"></textarea>
                    </div>
                </div>
            </div>
            <div class="col">
                <h4 class="row mb-3">Propose</h4>
                <div class="row mb-3">
                    <label for="ppb_propose_name" class="col-md-4 col-form-label">Propose Name : </label>
                    <div class="col-md-5">
                        <input type="text" name="ppb_propose_name" id="ppb_propose_name" class="form-control" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="ppb_propose_pos" class="col-md-4 col-form-label">Propose Position : </label>
                    <div class="col-md-5">
                        <input type="text" name="ppb_propose_pos" id="ppb_propose_pos" class="form-control" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="ppb_propose_date" class="col-md-4 col-form-label">Propose Date : </label>
                    <div class="col-md-5">
                        <input type="date" class="form-control" name="ppb_propose_date" id="ppb_propose_date" value="{{$today}}">
                    </div>
                </div>
                <div class="mt-4 d-flex align-items-center justify-content-center">
                    <button type="submit" class="btn btn-dark form-control" style="width: 40%">Next</button>
                </div>
            </div>
            <div class="w-100"></div>
            <div class="col">
            </div>
        </form>
    </div>

</body>
</html>
