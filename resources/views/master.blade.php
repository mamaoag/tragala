<html>
<script>
    window.Laravel = { csrfToken: '{{ csrf_token() }}' };
</script>
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/bulma.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <style>
    .facebook{
        color:#3b5999;    
    }
    .twitter{
        color:#55acee;
    }
    .youtube{
        color:#cd201f;
    }
    .white{
        color:#fff;
    }
    .upload {
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;
    }
    .menu-list > li > a.is-active{
        background:#ff7473;
    }
    .menu-list > li > a:hover{
        background:#ff7473;
    }
    </style>
</head>
<body>
    <div id="app">
    @include('partials.navigation')
    <div class="columns is-gapless">
        @if(Auth::check())
        <div class="column is-2">
            @include('partials.menu')
        </div>
        @endif
        <div class="column">
            @if(Auth::check() && (Route::is('home') || Request::is('trending') || Request::is('hot') || Request::is('latest')))
                @include('partials.second-navigation')
            @endif
            @yield('content')
            @if(Auth::check())
                <notification :id="{{Auth::user()->id}}"></notification>
            @endif
        </div>
    </div>
    <footer class="footer white" style="background:#3E4348;margin-top: -20">
        <div class="container">
            <div class="content has-text-centered white">
                <p>Created by Jio Mamaoag. Images goes to their respective owners</p>
                <p>
                    <span class="fa-stack fa-2x"><i class="fa fa-circle fa-stack-2x facebook"></i><i class="fa fa-stack-1x fa-facebook white"></i></span>
                    <span class="fa-stack fa-2x"><i class="fa fa-circle fa-stack-2x youtube"></i><i class="fa fa-stack-1x fa-youtube-play white"></i></span>
                    <span class="fa-stack fa-2x"><i class="fa fa-circle fa-stack-2x twitter"></i><i class="fa fa-stack-1x fa-twitter white"></i></span>
                </p>
            </div>
        </div>
    </footer>
    </div>
    <script src="/js/app.js"></script>
    <script>
        @if(Session::has('error'))
            noty({
                type: 'error',
                layout: 'topCenter',
                theme: 'metroui',
                timeout: 5000,
                text: '{{Session::get('error')}}' 
            });
        @endif
        @if(Session::has('info'))
            noty({
                type: 'info',
                layout: 'topCenter',
                theme: 'metroui',
                timeout: 5000,
                text: '{{Session::get('info')}}'
            });
        @endif
        @if(Session::has('notice'))
            noty({
                type: 'warning',
                layout: 'topCenter',
                theme: 'metroui',
                timeout: 5000,
                text: '{{Session::get('notice')}}';
            });
        @endif
    </script>
</body>
</html>