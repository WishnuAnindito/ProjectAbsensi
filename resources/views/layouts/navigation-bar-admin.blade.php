<div class="wrapper">
  <!-- Sidebar  -->
  <nav id="sidebar">
      <div class="sidebar-header">
          <h3>PT. Tangara Mitrakom</h3>
      </div>     
      <ul class="list-unstyled components">
          <li class="{{ request()->routeIs('dashboard-admin') ? 'active' : '' }}">
              <a href="{{route('dashboard-admin')}}">Dashboard</a>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" href="#employeeDropdown" data-bs-toggle="collapse" aria-expanded="false">Employee</a>
                <ul class="collapse list-unstyled" id="employeeDropdown">
                    <li class="{{ request()->routeIs('employee-list-admin') ? 'active' : '' }}">
                        <a href="{{route('employee-list-admin')}}">Employee List</a>
                    </li>
                    <li class="{{ request()->routeIs('over-time-admin') ? 'active' : '' }}">
                        <a href="{{route('over-time-admin')}}">Overtime</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" href="#historyDropdown" data-bs-toggle="collapse" aria-expanded="false">History</a>
                <ul class="collapse list-unstyled" id="historyDropdown">
                    <li class="{{ request()->routeIs('on-time-admin') ? 'active' : '' }}">
                        <a href="{{route('on-time-admin')}}">On Time</a>
                    </li>
                    <li class="{{ request()->routeIs('late-time-admin') ? 'active' : '' }}">
                        <a href="{{route('late-time-admin')}}">Late Time</a>
                    </li>
                    <li class="{{ request()->routeIs('leave-early-admin') ? 'active' : '' }}">
                        <a href="{{route('leave-early-admin')}}">Leave Early</a>
                    </li>
                    <li class="{{ request()->routeIs('leave-on-time-admin') ? 'active' : '' }}">
                        <a href="{{route('leave-on-time-admin')}}">Leave On Time</a>
                    </li>
    
                </ul>
            </li>
            <li class="{{ request()->routeIs('weekly-report-admin') ? 'active' : '' }}">
                <a href="{{route('weekly-report-admin')}}">Report</a>
            </li>
      </ul>
      <div class="fixed-bottom" style="width: 10%">
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
        <nav class="navbar navbar-expand-lg navbar-info bg-info mb-0">
            <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="btn btn-info">
                    <i class="fas fa-align-left"></i>
                </button>
            </div>
        </nav>
        @yield('content')
    </div>
</div>