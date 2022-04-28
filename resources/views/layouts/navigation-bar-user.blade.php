{{-- <div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3>PT. Tangara Mitrakom</h3>
        </div>
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
    </div>
</div> --}}
@yield('content')