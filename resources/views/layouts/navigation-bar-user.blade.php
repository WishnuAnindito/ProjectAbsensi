<div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3>PT. Tangara Mitrakom</h3>
        </div>     
        <ul class="list-unstyled components">
            <li class="{{ request()->routeIs('dashboard-employee') ? 'active' : '' }} ms-4">
                <a href="{{route('dashboard-employee')}}"><i class="fa-solid fa-house-chimney"></i>&ensp;Dashboard</a>
            </li>
            <li class="{{ request()->routeIs('profile-employee') ? 'active' : '' }} ms-4">
                <a href="{{route('profile-employee')}}"><i class="fa-solid fa-user-gear"></i>&ensp;Profile</a>
            </li>
            <li class="{{ request()->routeIs('task-employee') ? 'active' : '' }} ms-4">
                <a href="{{route('task-employee')}}"><i class="fa-solid fa-list-check"></i>&ensp;My Task</a>
            </li>
            {{-- <li class="{{ request()->routeIs('attendance-employee') ? 'active' : '' }}">
                <a href="{{route('attendance-employee')}}">Presence</a>
            </li>
            <li class="{{ request()->routeIs('history-employee') ? 'active' : '' }}">
                <a href="{{route('history-employee')}}">History</a>
            </li> --}}
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