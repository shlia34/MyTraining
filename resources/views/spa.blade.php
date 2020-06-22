
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

        <!-- js-file -->
{{--        <script src="/js/ajax-setup.js"></script>--}}
        <!-- Fullcalendar -->
        <link href='/css/fullcalendar/core/main.css' type="text/css" rel='stylesheet' />
        <link href='/css/fullcalendar/daygrid/main.css' type="text/css" rel='stylesheet' />
        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href='/css/style.css' type="text/css" rel='stylesheet' />
    </head>

    <body>

        <div id="app"></div>

        <script src="{{ mix('js/app.js') }}" defer></script>

    </body>
</html>

