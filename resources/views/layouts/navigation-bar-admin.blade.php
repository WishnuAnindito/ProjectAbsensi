<div class="wrapper">
  <!-- Sidebar  -->
  <nav id="sidebar">
      <div class="sidebar-header">
          <h3>PT. Tangara Mitrakom</h3>
      </div>     
      <ul class="list-unstyled components">
          <li class="active">
              <a href="{{route('dashboard-admin')}}">Dashboard</a>
            </li>
            <li>
                <a href="{{route('employee-list')}}">Employee</a>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" href="#historyDropdown" data-bs-toggle="collapse" aria-expanded="false">History</a>
                <ul class="collapse list-unstyled" id="historyDropdown">
                    <li><a href="{{route('on-time')}}">On Time</a></li>
                    <li><a href="{{route('late-time')}}">Late Time</a></li>
                    <li><a href="{{route('leave-early')}}">Leave Early</a></li>
                    <li><a href="{{route('leave-on-time')}}">Leave On Time</a></li>
                    <li><a href="{{route('over-time')}}">Overtime</a></li>
                </ul>
            </li>
            <li>
                <a href="{{route('weekly-report')}}">Report</a>
            </li>
      </ul>
      <div class="fixed-bottom">
          <form action="{{route('logout')}}" method="POST">
            @csrf
            <button type="submit" class="btn text-white">
                Logout
            </button>
        </form>
      </div>
    </nav>

    <!-- Page Content  -->
    <div id="content">
        
        {{-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-0">
            <div class="container-fluid">
                
                <button type="button" id="sidebarCollapse" class="btn btn-dark">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-align-justify"></i>
                </button>
                
                <div class="navbar nav mb-0">
                    <a class="nav-link dropdown-toggle text-white me-2" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Admin
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <div>
                            <a class="dropdown-item" href="#">Profile</a>
                        </div>
                        <hr class="dropdown-divider">
                        <form action="{{route('logout')}}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-link dropdown-item">
                                Logout
                            </button>
                        </form>
                    </div> 
                </div>
            </div>
        </nav> --}}
        @yield('content')
    </div>
</div>