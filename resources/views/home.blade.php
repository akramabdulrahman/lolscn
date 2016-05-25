@extends('layouts.home')

@section('content')
<div class="clear"></div>
<div class="right_ticker_chat">
    @include('partials.notification.fixed')
    <div class="lightbox" id="fl1">
        <div class="notheader">
            <div class="notheadertitle">Friends</div>
        </div>
        <div class="clear"></div>

        @include('partials.notification.friends')

    </div>
    <div class="lightbox" id="fl2">
        <div class="notheader">
            <div class="notheadertitle">Messages</div>
        </div>
        <div class="clear"></div>

        @include('partials.notification.messages')

    </div>

    <div class="lightbox" id="fl3">
        <div class="notheader">
            <div class="notheadertitle">Notifcations</div>
        </div>
        <div class="clear"></div>
        @include('partials.notification.likes')
    </div>
    <div class="leftsideprofile">
        <div class="profile"> 
            <a href="{{url('profile/settings')}}" ><div class="editmyprofile"></div></a>
            <div class="circle" ><img src='{{ url("images/profile/".Auth::user()->id) }}'></div>
            <div class="profileName">{{$currentUser->name }}</div>
            <div class="nickName">{{$currentUser->nickname }}</div>
        </div> 
        <form role="form" method="POST" action="{{ url('/post') }}">
            <div class="postFeeds">
                <div class="feedPost">
                    {!! csrf_field() !!}
                    <textarea placeholder="Think Like Teemo !" name="body" value="{{ old('body') }}" class="whatyouthink"></textarea>
                    <div class="upladoImage"><input type="file" name="upload"/></div>
                    <div class="postButton">
                        <button type="submit" class="pushButton">Post</button>
                    </div>
                </div>
            </div>
        </form>
        <div class="clear"></div>
        <div class="giveawawy">
            <div class="moveallshit">
                <div class="leftCircle">
                    <div class="thisweek">This Week</div>
                    <div class="currentwinner"></div>
                    <div class="thisweekskin">Arcade Sona</div>
                    <div class="thisweekwinner">????</div>
                </div>
                <div class="centerCircle">
                    <div class="countwinner"></div>
                    <div class="skinname">Arcade Miss Fortune</div>
                    <div class="skintime">24:30:50</div>
                </div>
                <div class="rightCircle">
                    <div class="lastweek">Last Week</div>
                    <div class="lastwinner"></div>
                    <div class="lastweekskin">Zombie Brand</div>
                    <div class="lastweekwinner">Mohammed Awad</div>
                </div>
            </div>
        </div>
        <div class="clear"></div>

        @include('flash')

        @if($posts->count() > 0)
        @include('partials.posts.posts', array('posts'=>$posts));
        @endif


    </div>
</div>
@endsection
