<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link href="{{ asset('https://fonts.googleapis.com/css?family=Nunito:200,600') }}" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">

        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
        <script src="{{ asset('js/jquery-1.11.3.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        {{-- <link type="text/css" rel="stylesheet" href="{{ mix('css/app.css') }}"> --}}
        @stack('styles')
        @stack('scripts')
    </head>
    <body><br><br>
{{--         @section('sidebar')
            This is the master sidebar.
        @show --}}
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ route('home') }}">
                    Entropia Movies
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="dropdown-toggle" data-toggle="dropdown">Producers
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="{{ route('person.index', ['role' => 'producers']) }}">List</a></li>
                          <li><a href="{{ route('person.create', ['role' => 'producers']) }}">Add</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="dropdown-toggle" data-toggle="dropdown">Actors
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="{{ route('person.index', ['role' => 'actors']) }}">List</a></li>
                          <li><a href="{{ route('person.create', ['role' => 'actors']) }}">Add</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="dropdown-toggle" data-toggle="dropdown">Movies
                        <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="{{ route('movies.index') }}">List</a></li>
                          <li><a href="{{ route('movies.create') }}">Add</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        @yield('content')
    </div>
    </body>
</html>
