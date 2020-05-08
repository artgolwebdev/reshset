<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                        @else
                            <li>
                                <a href="{{ route('home')}}" title="Home">
                                    <i class="glyphicon glyphicon-home"></i>
                                    <span class="visible-xs-art"> Home</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('search') }}" title="Search">
                                    <i class="glyphicon glyphicon-search"></i>
                                    <span class="visible-xs-art"> Search</span>
                                </a>
                            </li>
                            <unreadnots></unreadnots>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <img src="{{ Auth::user()->avatar }}" width="10px" height="10px">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('profile',['slug'=>Auth::user()->slug]) }}">
                                            <i class="glyphicon glyphicon-user"></i>
                                            Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="glyphicon glyphicon-log-out"></i>
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        
        <init></init>

        @yield('content')

        @if(Auth::user())
            <notification :id="{{ Auth::id() }}"></notification>
            <audio id="noty_audio">
                <source src="{{ asset('audio/notify.mp3') }}">
                <source src="{{ asset('audio/notify.ogg') }}">
                <source src="{{ asset('audio/notify.wav') }}">
            </audio>
        @endif
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script>
        @if(Session::has('success'))
            new Noty({
                type : 'success' , 
                layout : 'topRight', 
                text : '{{ Session::get('success')}}' , 
                theme : 'mint'  ,
                progressBar : true , 
                timeout : 3500
            }).show();
        @endif
    </script>

    <script>
        $(function(){
            var links = $('.nav.navbar-nav.navbar-right li');
            $.each(links,function(){
                if($(this).find('a').attr('href') == window.location.href){
                    $(this).addClass('active');
                }
            })
        })
    </script>

    @yield('scripts')


</body>
</html>
