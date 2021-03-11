<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Beirutiyat') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('css')
    <style>
        .matches-header{
            display: inline-block;
            color:#D54D71;
        }
        .number {
            display: inline-block;
            border-radius: 50%;
            width: 22px;
            height: 22px;
            padding: 0px;
            text-align: center;
        }
        .messages-container{
            width: -webkit-fill-available;
            box-sizing: content-box;
            position: absolute;
            bottom: 0;
        }
        .messages-container > div{
            overflow: scroll;
            height: 70vh;
            max-height: calc(100vh - 211px) !important;
        }
        .messages-header h6{
            color: #F2C342;
            display: inline-block;
        }
        .messages-header .number{
            font-size: 1rem;
            background:#F2C342;
            color: white;
        }
        .messages-container .rounded-top{
            border-radius: 2em 2em 0 0 !important;
        }
        .rounded{
            border-radius: 1em!important;
        }
        .message i{
            font-size: .8rem;
            left: calc(50px - .3rem);
            position: absolute;
            color:#52AE57;
            -webkit-text-stroke-width: 2px;
            -webkit-text-stroke-color: #E1E5E8;
        }

        .tab{
            position: relative;
            font-size: 20px;
        }
        .tab p{
            display: none;
            position: absolute;
            font-size: 12px;
            top: 10px;
            color:#449249;
            text-transform: capitalize;
        }
        p.matches{
            left: calc(50% - 24px);
        }
        p.profile{
            left: calc(50% - 20px);
        }
        p.home{
            left: calc(50% - 18px);
        }
        .tab.active p{
            display: block;
        }
        .tab i{
            position: absolute;
            left: calc(50% - 10px);
        }
        .tab.active .dent{
            display: inline-block;
            position: absolute;
            top: -36px;
            border-radius: 100%;
            background: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='10 10 45 15'  width='64' height='64' fill='#f8f9fa'><path d='M12 24 L52 24 L52 16 C40 16 42 10 32 10 C20 10 22 16 12 16 Z' /></svg>") 0 0/100% 100% no-repeat;
            width: 60px;
            height: 60px;
            left: calc(50% - 30px);
        }
        .tab.active i{
            top: -10px;
            color: #449249;
        }
        .navbar.fixed-bottom{
            height: 40px;
        }
        .matches{
            height: 80px;
            overflow-x: scroll;
            overflow-y:hidden;
            white-space:nowrap;
        }
        .matches-cont .number{
            font-size: 1rem;
            background:#D54D71;
            color: white;
        }
        .rounded-image{
            border-radius: 50%;
            box-shadow: 0 0 1px 1px #E1E5E8;
        }
        .like{
            display: inline-block;
            width: 70px;
            position: relative;
            margin-left: 1.5em;
        }
        .like p{
            text-align: center;
            color:#D54D71;
            text-transform: capitalize;
        }
        .like i{
            font-size: .8rem;
            left: calc(50px - .2rem);
            top: 1px;
            position: absolute;
            color:#D54D71;
            -webkit-text-stroke-width: 2px;
            -webkit-text-stroke-color: #E1E5E8;

        }
        .match{
            display: inline-block;
            width: 70px;
            position: relative;
            margin-left: 1.5em;
        }
        .match p{
            text-align: center;
            color:#111D20;
            text-transform: capitalize;
        }
        .match i{
            font-size: .8rem;
            left: calc(50px - .2rem);
            top: 1px;
            position: absolute;
            color:#52AE57;
            -webkit-text-stroke-width: 2px;
            -webkit-text-stroke-color: #E1E5E8;

        }
        a{
            text-decoration: none;
        }

        body{
            background-color: #f8f9fa!important;
        }
    </style>
</head>
<body>
<div class="nav-scroller bg--body shadow-sm d-none d-sm-block">
    <nav class="nav nav-underline" aria-label="Navigation">
        <a class="nav-link" href="{{route('home')}}">Home</a>
        <a class="nav-link active" href="{{route('matches')}}" aria-current="page">Matches</a>
        <a class="nav-link" href="{{route('home')}}">Profile</a>
    </nav>
</div>
<main>
    @yield('content')
</main>

<nav class="navbar fixed-bottom  navbar-light bg-light d-block d-sm-none">
    <div class="container-fluid">
        <div class="col-4 text-center tab @if (  request()->is('profile')) {{'active'}} @endif"><div class="dent"></div><a><i class="fas fa-user-circle"></i></a><p class="profile">profile</p></div>
        <div class="col-4 text-center tab @if (  request()->is('home')) {{'active'}} @endif"><div class="dent"></div><a href="{{route("home")}}"><i class="fas fa-heart"></i></a><p class="home">home</p></div>
        <div class="col-4 text-center tab @if (  request()->is('matches*')) {{'active'}} @endif"><div class="dent"></div> <a href="{{route("matches")}}"><i class="far fa-comments"></i></a><p class="matches">matches</p></div>
    </div>
</nav>
<script src="https://kit.fontawesome.com/c4c221ed03.js" crossorigin="anonymous" defer></script>
</body>
</html>
