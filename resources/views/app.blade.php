<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">


        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <style>
        a, button {
            -webkit-tap-highlight-color: rgba(0, 0, 0, 0) !important;
            -webkit-tap-highlight-color: transparent !important;

        }
        .ce-header {
            font-weight: bold;
            font-size: 20px;
        }
        html {
            scroll-behavior: smooth;
            scroll-padding: 5rem;
        }


    </style>
    <body class="overflow-x-hidden">
    @inertia
    </body>

</html>
