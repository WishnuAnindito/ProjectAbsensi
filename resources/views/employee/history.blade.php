@extends('layouts.template')
@section('title', 'History')

@section('css')
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.css"/>
@endsection

@section('nav')
@extends('layouts.navigation-bar-user')
@section('content')
    <div class="container-fluid py-5" style="background-color: #bff5f3">
        <h1 class="text-center" style="font-family: 'Montserrat', sans-serif;font-weight: 800">PT. Tangara Mitrakom</h1>
    </div>
    <a href="{{route('dashboard')}}" class="btn btn-primary mt-3 ms-2">Back to Dashboard</a>
    <div class="container-fluid mt-2 border border-2 border-dark">
        <table id="history" class="table table-info table-striped">
            <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Task Code</th>
                    <th scope="col">Task Name</th>
                    <th scope="col">Waktu Tiba</th>
                    <th scope="col">Waktu Selesai</th>
                    <th scope="col">Lokasi</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row"></th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
  
      </div>
@endsection

@section('script')
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.js"></script>
  <script type="text/javascript">
      $(document).ready( function () {
      $('#history').DataTable();
      } );
  </script>
@endsection