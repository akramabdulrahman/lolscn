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
                    
                 @if (session('status'))
                 
                  <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="success" aria-label="close">&times;</a>
                <span class="glyphicon glyphicon-ok"></span> {{ session('status') }}
            </div>

                    @endif

            <div class="custom_text_signin">enter the email you want to reset</div>

            <form role="form" method="POST" action="{{ url('/password/email') }}" >
                {!! csrf_field() !!}
                <input class="signup_input" type="email" name="email" placeholder="Email" required value="{{ old('email') }}">

                <button class="signup_button" type="submit">Send Password Reset Link</button>
            </form>
    </div>
</div>
</div>




@endsection
