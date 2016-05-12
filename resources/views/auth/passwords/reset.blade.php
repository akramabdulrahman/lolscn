@extends('layouts.landing')
@section('content')

<div class="main_signin">

    <div class="signin_box">
        <div class="top_signin_box">
            <div class="left_top_signin_box">
                Reset Password
            </div>
            <div class="right_top_signin_box">
                <a href="#"><img class="hvr-bounce-in hvr-buzz" style="width:17px;height: 17px;" src="{{ url('img/close.svg') }}" alt="Close"></a>
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
            @if ($errors->has('password_confirmation'))
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <span class="glyphicon glyphicon-remove"></span> {{ $errors->first('password_confirmation') }}
            </div>
            @endif
            <div class="custom_text_signin">enter the email you want to reset</div>

            <form role="form" method="POST" action="{{ url('/password/reset') }}" >
                {!! csrf_field() !!}
                <input type="hidden" name="token" value="{{ $token }}">


                        <input type="email" class="signup_input" name="email" value="{{ $email or old('email') }}">

                     
                        <input type="password" class="signup_input" class="form-control" name="password">

                      
                        <input type="password" class="signup_input" class="form-control" name="password_confirmation">
                        <button class="signup_button" type="submit">Reset Password</button>

            </form>
        </div>
    </div>
</div>




@endsection
