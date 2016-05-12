@extends('layouts.landing')
@section('content')

<div class="main_signin">

    <div class="signin_box">
        <div class="top_signin_box">
            <div class="left_top_signin_box">
                Sign In
            </div>
            <div class="right_top_signin_box">
                <a href="#"><img class="hvr-bounce-in hvr-buzz" style="width:17px;height: 17px;" src="img/close.svg" alt="Close"></a>
            </div>                    
        </div>
        <div class="custom_inputs">
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
            <div class="custom_text_signin">Hello there, haven’t we seen you before</div>

            <form role="form" method="POST" action="{{ url('/login') }}" >
                {!! csrf_field() !!}
                <input class="signup_input" type="email" name="email" placeholder="Email" required value="{{ old('email') }}">
                
                <input class="signup_input" type="password" name="password" placeholder="Password" required=""/>
                <div class="left_signin">
                    <div class="squaredFour">
                        <input type="checkbox" value="None" id="squaredFour" name="check" />
                        <label for="squaredFour"></label>
                    </div>
                    <span class="Remmberme">Remmber Me</span>
                </div>
                <div class="right_signin">
                    <span class="forgetmypassword"><a href="{{ url('/password/reset') }}">I forgot my password</a></span>
                </div>
                <button class="signup_button" type="submit">SIGN IN</button>
            </form>
        </div>
        <div class="right_signin">
            <span class="sochilaaccounts">Sign With Your Social Media Account</span>
        </div>
        <div class="right_social">
            <a href="{{ url('/login/facebook/') }}"><img src="img/facebook.png" width="33" height="33" alt="facebook"></a>

            <a href="{{ url('/login/google/') }}"><img src="img/google.png" width="33" height="33" alt="twitter"></a>
        </div>
    </div>
</div>




@endsection