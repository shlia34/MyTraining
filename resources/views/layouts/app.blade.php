<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'MyTraining') }}</title>

    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/js/mdb.min.js"></script>
    <!-- Fullcalendar  -->
    <script src='/js/fullcalendar/core/main.js'></script>
    <script src='/js/fullcalendar/core/locales/ja.js'></script>
    <script src='/js/fullcalendar/daygrid/main.js'></script>
    <script src='/js/fullcalendar/interaction/main.js'></script>
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- js-file -->
    <script src="/js/ajax-setup.js"></script>
    <script src="/js/ajax-function.js"></script>
    <script src="/js/build-html-function.js"></script>
    <script src="/js/event-control.js"></script>
    <script src="/js/training-control.js"></script>
    <script src="/js/choice-control.js"></script>
    <script src="/js/boostrap.js"></script>

    <!-- Fonts -->
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Fullcalendar -->
    <link href='/css/fullcalendar/core/main.css' type="text/css" rel='stylesheet' />
    <link href='/css/fullcalendar/daygrid/main.css' type="text/css" rel='stylesheet' />
    <!-- remodal -->
    <link href='/css/remodal/remodal.css' type="text/css" rel='stylesheet' />
    <link href='/css/remodal/remodal-default-theme.css' type="text/css" rel='stylesheet' />
    <script src='/js/remodal/remodal.js'></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href='/css/style.css' type="text/css" rel='stylesheet' />
    <link href='/css/boostrap.css' type="text/css" rel='stylesheet' />
    <!-- Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/css/mdb.min.css" rel="stylesheet">

</head>

<body>

<!--Navbar-->
<nav class="navbar fixed-top">
    <!-- Navbar brand -->
    <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'MyTraining') }}</a>

    @auth
        <!-- Collapse button -->
        <button class="navbar-toggler second-button" type="button" data-toggle="collapse" data-target="#navbarSupportedContent23"
                aria-controls="navbarSupportedContent23" aria-expanded="false" aria-label="Toggle navigation">
            <div class="animated-icon2"><span></span><span></span><span></span><span></span></div>
        </button>

        <!-- Collapsible content -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent23">

            <!-- Links -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/stages/index">種目</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/csv/index">CSV</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">ログアウト</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
            <!-- Links -->
        </div>
        <!-- Collapsible content -->
    @endauth

</nav>
<!--/.Navbar-->

@yield('content')

</body>
</html>
