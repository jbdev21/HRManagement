    <div id="main-wrapper"  data-navbarbg="skin6" data-theme="light" data-layout="vertical" data-sidebartype="full"
        data-boxed-layout="full">
        <header class="topbar d-print-none" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header" data-logobg="skin5">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                        <i class="ti-menu ti-close"></i>
                    </a>
                    <div class="navbar-brand">
                        <span href="#" class="logo">
                            <span class="logo-text text-white" style="font-size: 0.8em;">
                                Logged: {{ ucfirst(Auth::user()->name) }}
                            </span>
                        </span>
                    </div>
                </div>
            </nav>
        </header>