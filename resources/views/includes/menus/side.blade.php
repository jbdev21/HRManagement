<aside class="left-sidebar d-print-none" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar ">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/dashboard"
                        aria-expanded="false">
                        <i class="mdi mdi-av-timer"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
              
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('employees.index') }}"
                        aria-expanded="false">
                        <i class="mdi mdi-format-paint"></i>
                        <span class="hide-menu">Employees</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('applicant.index') }}"
                        aria-expanded="false">
                        <i class="mdi mdi-format-paint"></i>
                        <span class="hide-menu">Applicant</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('leave.index') }}"
                        aria-expanded="false">
                        <i class="mdi mdi-file"></i>
                        <span class="hide-menu">Leaves</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('departments.index') }}"
                        aria-expanded="false">
                        <i class="mdi mdi-cash"></i>
                        <span class="hide-menu">Departments</span>
                    </a>
                </li>
               
                
                @if(Auth::user()->type == "administrator")
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('user.index') }}"
                            aria-expanded="false">
                            <i class="mdi mdi-account-multiple"></i>
                            <span class="hide-menu">Users</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ route('category.index') }}"
                            aria-expanded="false">
                            <i class="mdi mdi-view-sequential"></i>
                            <span class="hide-menu">Categories</span>
                        </a>
                    </li>
                @endif
                <hr>
                <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark sidebar-link" href="/"
                        aria-expanded="false" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        <i class="mdi mdi-power-settings"></i>
                        <span class="hide-menu">Logout</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>

<div class="page-wrapper">