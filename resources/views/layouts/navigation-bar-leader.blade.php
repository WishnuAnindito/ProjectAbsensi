<div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3>PT. Tangara Mitrakom</h3>
        </div>     
        <ul class="list-unstyled components">
            <li class="{{ request()->routeIs('dashboard-leader') ? 'active' : '' }}">
                <a href="{{route('dashboard-leader')}}">Dashboard</a>
              </li>
              <li class="{{ request()->routeIs('employee-list-leader') ? 'active' : '' }}">
                  <a href="{{route('employee-list-leader')}}">Employee</a>
              </li>
              <li class="dropdown">
                  <a class="dropdown-toggle" href="#historyDropdown" data-bs-toggle="collapse" aria-expanded="false">History</a>
                  <ul class="collapse list-unstyled" id="historyDropdown">
                      <li class="{{ request()->routeIs('on-time-leader') ? 'active' : '' }}">
                          <a href="{{route('on-time-leader')}}">On Time</a>
                      </li>
                      <li class="{{ request()->routeIs('late-time-leader') ? 'active' : '' }}">
                          <a href="{{route('late-time-leader')}}">Late Time</a>
                      </li>
                      <li class="{{ request()->routeIs('leave-early-leader') ? 'active' : '' }}">
                          <a href="{{route('leave-early-leader')}}">Leave Early</a>
                      </li>
                      <li class="{{ request()->routeIs('leave-on-time-leader') ? 'active' : '' }}">
                          <a href="{{route('leave-on-time-leader')}}">Leave On Time</a>
                      </li>
                      <li class="{{ request()->routeIs('over-time-leader') ? 'active' : '' }}">
                          <a href="{{route('over-time-leader')}}">Overtime</a>
                      </li>
                  </ul>
              </li>
              <li class="{{ request()->routeIs('weekly-report-leader') ? 'active' : '' }}">
                  <a href="{{route('weekly-report-leader')}}">Report</a>
              </li>
              <li class="{{ request()->routeIs('create-task') ? 'active' : '' }}">
                  <a href="{{route('create-task')}}">Create Task</a>
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
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">

                <button type="button" id="sidebarCollapse" class="btn btn-dark">
                    <i class="fas fa-align-left"></i>
                </button>
            </div>
        </nav>
          @yield('content')
      </div>
  </div>