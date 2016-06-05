@extends('layouts.landing')

@section('content')

        <div class="main_content">
        <div class="main_text"><span class="custom_text">You can use to find friends </span>, communicate with them and knowing the nature of the play search engine</div>
        <div class="main_search">
           @include('partials.search.form1')
        </div>
        <div class="main_buttons">
        <a href="{{ url('/register') }}"><button class="button_signin hvr-fade" type="submit">SING UP</button></a>
        <a href="{{ url('/login') }}"><button class="button_signin hvr-fade" type="submit">SIGN IN</button></a>
        </div>
    </div>

@endsection
