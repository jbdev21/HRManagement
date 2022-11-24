<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('includes.sections.header')
    <body >
        @include('includes.menus.top')   
        @include('includes.menus.side')
           <!-- Content -->
        <div class="container-fluid" id="app" style="background-image:url(assets/images/bg.jpg); background:position:top; background-size:cover; min-height:93vh" >
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @yield('content')
        </div>

        @include('includes.sections.footer')
        <script src="{{ asset('/js/app.js') }}" />
    </body>
</html>