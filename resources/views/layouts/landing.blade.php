<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Elo Fight</title>
        <meta charset="UTF-8">

        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
        <script   src="https://code.jquery.com/jquery-2.2.3.min.js"   integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo="   crossorigin="anonymous"></script>
        <!-- Styles -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{ url('css/hover.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ url('css/style.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ url('css/reset.css') }}" rel="stylesheet" type="text/css"/>
    </head>
    <body>

        <div class="top_navigation ">
            <div class="left">
                <div class="logo"><img src="{{ url('img/logo.svg') }}" alt="Elo Fight Logo"></div>
                <div class="website_name">Elofight</div>
            </div>
            <div class="right">
                <ul>
                    <li><a class="" href="/">HOME</a></li>
                    <li><a href="{{ url('/register') }}">SIGNUP</a></li>
                    <li><a href="{{ url('/login') }}">SIGNIN</a></li>
                    <li><a href="{{ url('/public') }}">PUBLIC STATUS</a></li>
                </ul>
            </div>
        </div>
        <div class="main_content">
            @yield('content')
        </div>
        <div class="main_footer">
            <div class="footer_text"> © 2015-2016 ELOFIGHT.COM. Data based on League of legends .</div>
        </div>

        <!-- JavaScripts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
