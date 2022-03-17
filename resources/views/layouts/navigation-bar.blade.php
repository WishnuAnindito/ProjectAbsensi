<div class="wrapper">
  <!-- Sidebar  -->
  <nav id="sidebar">
      <div class="sidebar-header">
          <h3>PT. Tangara Mitrakom</h3>
      </div>
      {{-- @auth()
      @if(Auth::user()->role == 'admin')     --}}
      <ul class="list-unstyled components">
          <li class="active">
              <a href="#">Dashboard</a>
            </li>
            <li>
                <a href="#">Attendance</a>
            </li>
            <li>
                <a href="#">History</a>
            </li>
            <li>
                <a href="#">Overtime</a>
            </li>
            <li>
                <a href="#">Schedule</a>
            </li>
            <li>
                <a href="#">Late Time</a>
            </li>
      </ul>
      <div>
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
        
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-0">
            <div class="container-fluid">
                
                <button type="button" id="sidebarCollapse" class="btn btn-dark">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-align-justify"></i>
                </button>
                
                <div class="navbar nav mb-0">
                    <a class="nav-link dropdown-toggle text-white me-2" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="storage\images\lennyfacediscordservericon.jpg" alt="" style="width: 40px; height: 30px">
                        Admin
                        {{-- {{Auth::user()->name}} --}}
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
        </nav>
        {{-- @elseif (Auth::user()->role == 'member')
        <ul class="list-unstyled components">
            <li class="active">
                <a href="#">Attendance</a>
            </li>
            <li>
                <a href="#">History</a>
            </li>
            <li>
                <a href="#">Overtime</a>
            </li>
            <li>
                <a href="#">Late Time</a>
            </li>
        </ul>
        <div>
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
          
          <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-0">
              <div class="container-fluid">
                  
                  <button type="button" id="sidebarCollapse" class="btn btn-dark">
                      <span class="navbar-toggler-icon"></span>
                  </button>
                  <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                      <i class="fas fa-align-justify"></i>
                  </button>
                  
                  <div class="navbar nav mb-0">
                      <a class="nav-link dropdown-toggle text-white me-2" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <img src="storage\images\lennyfacediscordservericon.jpg" alt="" style="width: 40px; height: 30px">
                          User
                          {{Auth::user()->name}}
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
        {{-- @endauth --}}
        @yield('content')
  </div>
</div>