<body>
    {{-- <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div> --}}
    <div id="main-wrapper" data-navbarbg="skin6" data-theme="light" data-layout="vertical" data-sidebartype="full"
        data-boxed-layout="full">
        <header class="topbar" data-navbarbg="skin6">
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
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin6">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item" style="margin-left: 14px;">
                            <b class="logo-icon">
                                <img src="{{ asset('assets/images/logo/paintLogo.png') }}" alt="homepage" width="50" class="light-logo" />
                            </b>
                            <span class="logo-text" style="margin-left: 14px;">
                                <img src="{{ asset('assets/images/logo/titleLogo.png') }}" class="light-logo" alt="homepage" />
                            </span>
                        </li>
                    </ul>
                    
                </div>
            </nav>
        </header>