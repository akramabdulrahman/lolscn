@extends('layouts.landing')

@section('content')




<div class="main_signup">

    <div class="signup_box">
        <div class="top_signup_box">
            <div class="left_top_signup_box">
                Sign Up
            </div>
            <div class="right_top_signup_box">
                <a href="#"><img class="hvr-bounce-in hvr-buzz" style="width:17px;height: 17px;" src="img/close.svg" alt="Close"></a>
            </div>                    
        </div>
        <div class="custom_inputs">
            @if ($errors->has('name'))
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <span class="glyphicon glyphicon-remove"></span> {{ $errors->first('name') }}
            </div>
            @endif
             @if ($errors->has('last_name'))
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <span class="glyphicon glyphicon-remove"></span> {{ $errors->first('nickname') }}
            </div>
            @endif
             @if ($errors->has('email'))
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <span class="glyphicon glyphicon-remove"></span> {{ $errors->first('email') }}
            </div>
            @endif
             @if ($errors->has('password'))
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <span class="glyphicon glyphicon-remove"></span> {{ $errors->first('password') }}
            </div>
            @endif
             @if ($errors->has('password_confirmation'))
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <span class="glyphicon glyphicon-remove"></span> {{ $errors->first('password_confirmation') }}
            </div>
            @endif

            <form role="form" method="POST" action="{{ url('/register') }}">
                {!! csrf_field() !!}
                <input type="text" class="signup_input" name="name" value="{{ old('name') }}" placeholder="First name" required="" />
                        <input type="text" class="signup_input" name="nickname" value="{{ old('nickname') }}" placeholder="Nickname" required />
                        <input type="email" class="signup_input" name="email" value="{{ old('email') }}" placeholder="Email" required />
                        <input type="password" class="signup_input" name="password"  placeholder="Password" required />
                        <input type="password" class="signup_input" name="password_confirmation" placeholder="Confirm Password" required />
                <button class="signup_button" type="submit">SIGN UP</button>
            </form>
        </div>
    </div>
</div>
@endsection
