@extends('layouts.template')
@section('title', 'Dashboard')

@section('nav')
@extends('layouts.navigation-bar-user')
@section('content')
    <div class="container mt-5">
        <div class="row">
            
            <div class="text-center" id="time" style="font-size: 100px"></div>
            <div class="fs-3 text-center" id="date"></div>
            
        </div>
    </div>
@endsection