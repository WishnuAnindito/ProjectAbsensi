@extends('layouts.template')
@section('title', 'Dashboard')

@section('nav')
@extends('layouts.navigation-bar-user')
@section('content')
    <div class="container mt-5 d-flex flex-column align-items-center justify-content-center">
        <div class="row">
            
            <div class="fs-1 text-center" id="time"></div>
            <h3 class="text-center">{{$today->format('d M Y')}}</h3>
            <h3 class="text-center">{{$userinfo->regionName}}, {{$userinfo->countryName}}</h3>
            
        </div>
        <br>
        <div class="row">
            <a href="{{route('attendance')}}" class="btn btn-success"></a>
        </div>
    </div>
@endsection