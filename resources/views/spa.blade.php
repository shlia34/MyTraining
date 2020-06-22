
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'MyTraining') }}</title>

        <script type="text/javascript">
            window.Laravel = window.Laravel || {};
            window.Laravel.csrfToken = "{{csrf_token()}}";
        </script>

        <!-- Scripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <!-- js-file -->
        <script src="/js/ajax-setup.js"></script>
        <!-- Fonts -->
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        <!-- Fullcalendar -->
        <link href='/css/fullcalendar/core/main.css' type="text/css" rel='stylesheet' />
        <link href='/css/fullcalendar/daygrid/main.css' type="text/css" rel='stylesheet' />
        <!-- Styles -->
        @if(app('env') == 'production')
            <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
        @else
            <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        @endif
        <link href='/css/style.css' type="text/css" rel='stylesheet' />
        <link href='/css/boostrap.css' type="text/css" rel='stylesheet' />
        <!-- Bootstrap -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.11/css/mdb.min.css" rel="stylesheet">

    </head>

    <body>

        <div id="app"></div>

        <script src="{{ mix('js/app.js') }}" defer></script>

    </body>
</html>

