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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
        <!-- Styles -->
        <link href="{{ url('css/flashlight.css') }}" rel="stylesheet" type="text/css"/>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{ url('css/hover.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ url('css/loguser.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ url('css/datepicker.css') }}" rel="stylesheet" type="text/css"/>
         <script src="https://code.jquery.com/jquery-2.2.3.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
    </head>
    <body>

        <div class="top_navigation">
            <div class="centerbutton">
                <div class="left">
                    <div class="logo"><img src="{{ url('img/logo.svg') }}" alt="Elo Fight Logo"></div>
                    <div class="website_name">Elofight</div>
                </div>
                <div class="right">
                    <div class="userinfologut">
                        <div class="usertopphoto">
                            <img src="{{ url('img/userPhoto.png') }}" class="img-circle" alt="userPhoto" width="30" height="30" />
                        </div>
                        <div class="userinfoname">
                            {{ Auth::user()->name }}
                        </div>
                        <div class="userinfologout">
                            <a href="{{ url('logout/') }}"><img src="{{ url('img/logout.svg') }}" alt="userPhoto" width="20" height="20" /></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
        <div class="top_main_nav">
            <div class="centerbuttonx">
                <div class="leftx1">
                    <input type="text" id="box" class="search_style" name="search" placeholder="Enter the summoner's name." />
                    <button type="submit" id="box2" class="search_button"><img style="width:22px;height: 22px;" src="img/search.svg" alt="Search"></button>
                    <div class="realmenu">
                        <ul>
                            <li><span class="iconforface sliding-u-l-r-l">Favourites</span></li>
                            <li><span class="iconforface1 sliding-u-l-r-l">My Accounts</span></li>
                            <li><span class="iconforface2 sliding-u-l-r-l">Team</span></li>
                            <li><span class="iconforface3 sliding-u-l-r-l">Clans</span></li>
                            <li><span class="iconforface4 sliding-u-l-r-l">Development</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear"></div>

        @yield('content')
        <!-- JavaScripts -->

        <script src="//cdn.rawgit.com/noelboss/featherlight/1.4.0/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
   

    <!--    {{ url('/logout') }}-->
    <script type="text/javascript">
$('#maxsearch').focus(function ()
{
    /*to make this flexible, I'm storing the current width in an attribute*/
    $(this).attr('data-default', $(this).width());
    $('.searchinputme').animate({"width": "125px"}, 'slow');
}).blur(function ()
{
    /* lookup the original width */
    var w = $(this).attr('data-default');
    $('.searchinputme').animate({"width": "95px"}, 'slow');

});



$('#box').focus(function ()
{
    /*to make this flexible, I'm storing the current width in an attribute*/
    $(this).attr('data-default', $(this).width());
    $('.search_button').animate({"marginLeft": "520px"}, 'slow');
    $('.search_style').animate({"width": "520px"}, 'slow');
}).blur(function ()
{
    /* lookup the original width */
    var w = $(this).attr('data-default');
    $('.search_button').animate({"marginLeft": "400px"}, 'slow');
    $('.search_style').animate({"width": "400px"}, 'slow');

});
    </script>

</body>
</html>
