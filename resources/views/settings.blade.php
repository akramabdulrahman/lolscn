@extends('layouts.home')
@section('content')

<div class="clear"></div>
<div class="right_ticker_chat">
    @if (session()->has('status'))
    <div class="alert alert-info">{{ session('message') }}</div>
    <div class="alert alert-info">{{ session('status') }}</div>
    @endif
    <div class="leftsideprofile">
        <div class="setting_page">
            <h1>Edit Profile</h1>
            <hr>
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="row">
                <!-- left column -->

                <form action="{{url('profile/update_cover')}}" method="post" enctype="multipart/form-data">
                    {!! csrf_field() !!}

                    <div class="col-xs-12">
                        <div class="text-center">
                            <img src="{{(!$currentUser->cover=='')?url("images/cover/".$currentUser->id):"//placehold.it/100"}}" class="avatar img-circle" alt="cover">
                            <h6></h6>
                            <input type="file" name="cover" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label"></label>
                        <div class="col-xs-9">
                            <input type="submit" class="btn btn-primary" value="Save Changes">
                            <span></span>
                            <input type="reset" class="btn btn-default" value="Cancel">
                        </div>
                    </div>
                </form>
            </div>
            <div class="row">
                <form action="{{url('profile/update_avatar')}}" method="post" enctype="multipart/form-data">
                    {!! csrf_field() !!}

                    <div class="col-xs-12">
                        <div class="text-center">
                            <img src="{{(!$currentUser->avatar=='')?url("images/profile/".$currentUser->id):"//placehold.it/350x150"}}" class="avatar" alt="avatar">
                            <h6>Upload a cover photo...</h6>
                            <input type="file" name="avatar" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label"></label>
                        <div class="col-xs-9">
                            <input type="submit" class="btn btn-primary" value="Save Changes">
                            <span></span>
                            <input type="reset" class="btn btn-default" value="Cancel">
                        </div>
                    </div>
                </form>
            </div>
            <div calss="row">
                <!-- edit form column -->
                <div class="col-xs-12 personal-info">
                    <h3>Personal info</h3>
                    {{ Form::model($currentUser, array('url' => ('profile/update'))) }}

                    <div class="form-group">
                        <label class="col-xs-3 control-label">Real name:</label>
                        <div class="col-xs-9">
                            <input class="form-control" type="text" name="name" value="{{$currentUser->name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">Nick name:</label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="nickname" value="{{$currentUser->nickname}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">Country:</label>
                        <div class="col-lg-9">
                            {{ Form::select('country_id', $countries) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">Email:</label>
                        <div class="col-lg-9">
                            <input class="form-control" type="text" name="email" value="{{$currentUser->email}}">
                        </div>
                    </div>
                    <div class="form-group">

                        <label class="col-xs-3 control-label">Birth date:</label>
                        <div class="col-lg-9">
                            <div class="input-append date" id="dp3" data-date="12-02-2012" data-date-format="dd-mm-yyyy">
                                <input class="span2" size="16" name="dob" type="text" value="{{$currentUser->dob}}" readonly>
                                <span class="add-on"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label">Mobile:</label>
                        <div class="col-md-9">
                            <input class="form-control" type="text" name="mobile" value="{{$currentUser->mobile}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-xs-3 control-label"></label>
                        <div class="col-xs-9">
                            <input type="submit" class="btn btn-primary" value="Save Changes">
                            <span></span>
                            <input type="reset" class="btn btn-default" value="Cancel">
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{Form::close()}}
                    <form method="post" action="{{url('newpass')}}" >


                        {!! csrf_field() !!}
                        @if( Auth::user()->hasPassword()))
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Old Password:</label>
                            <div class="col-md-9">
                                <input class="form-control" type="password" name="old_password" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Password:</label>
                            <div class="col-md-9">
                                <input class="form-control" type="password" name="new_password" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Confirm password:</label>
                            <div class="col-md-9">
                                <input class="form-control" type="password" name="new_password_confirmation" value="">
                            </div>
                        </div>
                        @endif
                        <div class="form-group">
                            <label class="col-xs-3 control-label"></label>
                            <div class="col-xs-9">
                                <input type="submit" class="btn btn-primary" value="update pass">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <hr>
        </div>
    </div>
</div>
<script src="{{url("js/bootstrap-datepicker.js")}}"></script>
<script>


    $(document).ready(function () {
        $('#dp3').datepicker();

        $('[data-toggle="tooltip"]').tooltip();
    });

    $('div.messagessend').on('keydown', '#inputComment', function (event) {
        if (event.keyCode == 13) {
            this.form.submit()
            return false;
        }
    });
</script>


<script>
    $(".showreply").on("click", function (e) {
        var postid = $(this).attr("data-reid");
        console.log(postid);
        $(".showreplyfor" + postid).css({display: "block"}).animate({opacity: "1"});
    });

    // Hide the extra content initially, using JS so that if JS is disabled, no problemo:
    $('.read-more-content').addClass('hide')

            // Set up a link to expand the hidden content:
            .before('<a class="read-more-show colorclass" href="#">Read More</a>')

    // Set up the toggle effect:
    $('.read-more-show').on('click', function (e) {
        $(this).next('.read-more-content').removeClass('hide');
        $(this).addClass('hide');
        e.preventDefault();
    });

</script>
</div>
@endsection