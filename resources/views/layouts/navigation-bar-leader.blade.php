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
              <li class="{{ request()->routeIs('employee-list') ? 'active' : '' }}">
                  <a href="{{route('employee-list')}}">Employee</a>
              </li>
              <li class="dropdown">
                  <a class="dropdown-toggle" href="#historyDropdown" data-bs-toggle="collapse" aria-expanded="false">History</a>
                  <ul class="collapse list-unstyled" id="historyDropdown">
                      <li class="{{ request()->routeIs('on-time') ? 'active' : '' }}">
                          <a href="{{route('on-time')}}">On Time</a>
                      </li>
                      <li class="{{ request()->routeIs('late-time') ? 'active' : '' }}">
                          <a href="{{route('late-time')}}">Late Time</a>
                      </li>
                      <li class="{{ request()->routeIs('leave-early') ? 'active' : '' }}">
                          <a href="{{route('leave-early')}}">Leave Early</a>
                      </li>
                      <li class="{{ request()->routeIs('leave-on-time') ? 'active' : '' }}">
                          <a href="{{route('leave-on-time')}}">Leave On Time</a>
                      </li>
                      <li class="{{ request()->routeIs('over-time') ? 'active' : '' }}">
                          <a href="{{route('over-time')}}">Overtime</a>
                      </li>
                  </ul>
              </li>
              <li class="{{ request()->routeIs('weekly-report') ? 'active' : '' }}">
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
          @yield('content')
      </div>
  </div>