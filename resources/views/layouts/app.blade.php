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

        window.OriginalLink = "{{ url('/') }}";
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default" id="header_id">
            <div class="container">
                <div class="navbar-header hidden-xs">


                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav hidden-xs">
                        &nbsp;
                       @if(Auth::user())
                       <div class="navbar-form navbar-left hidden-xs search-nav-holder">
                            <div class="input-group">
                                <search></search>
                            </div>
                        </div>
                        @endif()
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
                                </a>
                            </li>
                             <li class="visible-xs">  
                                <a href="{{ route('search') }}" title="Search">
                                    <i class="glyphicon glyphicon-search"></i>
                                </a>
                            </li> 
                            <unreadnots></unreadnots>

                            <unread-messages></unread-messages>

                            <li>
                                <a href="{{ route('profile',['slug'=>Auth::user()->slug]) }}">
                                    <i class="glyphicon glyphicon-user"></i>
                                </a>
                            </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
            </div>
        </nav>
        
        <init></init>

        @yield('content')

        @if(Auth::user())
            <notification :id="{{ Auth::id() }}"></notification>
            <unread-notification :id="{{ Auth::id() }}"></unread-notification>
            <new-post-update id="{{ Auth::id() }}"></new-post-update>

            <audio id="noty_audio">
                <source src="{{ asset('audio/notify.mp3') }}">
                <source src="{{ asset('audio/notify.ogg') }}">
                <source src="{{ asset('audio/notify.wav') }}">
            </audio>
            <audio id="new_message_audio">
                <source src="{{ asset('audio/clearly.m4r') }}">
                <source src="{{ asset('audio/clearly.ogg') }}">
                <source src="{{ asset('audio/clearly.mp3') }}">
            </audio>
        @endif
    </div>
    <a  class="text-center" id="scroll_to_top_id"><i class="glyphicon glyphicon-chevron-up"></i></a>
    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script>
        @if(Session::has('success'))
            new Noty({
                type : 'info' , 
                 text : '{{ Session::get('success')}}' , 
            }).show();
        @endif
    </script>

    <script>

        var links = document.querySelectorAll('.nav.navbar-nav.navbar-right li');
        links.forEach(function(link){
            var l = link.children;
            if(l[0].getAttribute('href')==window.location.href){
                link.classList.add('active');
            }
        })

        /*
        *  Scroll To Top
        */

        var your_header        = document.getElementById('header_id'),
            scroll_to_top   = document.getElementById('scroll_to_top_id');


        window.onscroll = function(ev) {
            console.log("Scroll..");
            var  scrollTop = window.pageYOffset || document.body.scrollTop;
            if (scrollTop > your_header.offsetHeight + 100) {

                if(window.innerWidth>420)scroll_to_top.style.display = 'block';
            }
            else{
                scroll_to_top.style.display = 'none';   
            }
        };

        scroll_to_top.onclick = function () {
            window.scrollTo(0,0);
        }


    </script>

    @yield('scripts')


</body>
</html>
