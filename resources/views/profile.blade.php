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
        <div class="profile_main">
            <div class="profile_cover"><img src="{{(!$currentUser->cover=='')?url("images/cover/".$currentUser->id):"//placehold.it/100"}}" alt="" class="imgradiuse" /></div>
            <div class="profile_image"><img src="{{(!$currentUser->profile=='')?url("images/profile/".$currentUser->id):"//placehold.it/100"}}" alt="" width="100" height="100" class="imgradiuse" /></div>

            <a href="{{url('messages/user/'.$user->id)}}"><div class="profile_sendmessag"><span class="send_message_prfoile">Send Message</span></div></a>

            <div class="profile_name">{{$user->name}}<br />{{$user->nickname}}</div>


            @if($currentUser->isFriendWith($user))
            <a href="{{url('/friendship/unfriend/'.$user->id)}}"><div class="profile_addfriend"><span class="addfriend_prfoile">Unfriend</span></div></a>
            @elseif($currentUser->hasFriendRequestFrom($user))
            <a href="{{url('/friendship/accept/'.$user->id)}}"><div class=""><span class="addfriend_prfoile">Accept Friendship</span></div></a>
            <a href="{{url('/friendship/decline/'.$user->id)}}"><div class=""><span class="addfriend_prfoile">Decline Friendship</span></div></a>
            @elseif($user->hasFriendRequestFrom($currentUser))
            <div class="profile_addfriend"><span class="addfriend_prfoile">Pending</span></div> 
            @elseif(!$currentUser->isFriendWith($user))
            <a href="{{url('/friendship/befriend/'.$user->id)}}"><div class="profile_addfriend"><span class="addfriend_prfoile">Send Request</span></div></a>

            @endif
        </div>
        <div class="clear"></div>
        <form role="form" method="POST" action="{{ ($user->id != $currentUser->id)?url('/post/onwall'):url('/post/') }}">
            <div class="postFeedsFriends">
                <div class="feedPost_profile">
                    {!! csrf_field() !!}
                    @if($user->id != $currentUser->id)
                    <input type="hidden" name="id" value="{{$user->id}}">
                    @endif
                    <textarea placeholder="Think Like Teemo !" name="body" value="{{ old('body') }}" class="whatyouthink_profile"></textarea>
                    <div class="upladoImage"><input type="file" name="upload"/></div>
                    <div class="postButton_profile">
                        <button type="submit" class="pushButton">Post</button>
                    </div>
                </div>
            </div>
        </form>
        <div class="clear"></div>

        @include('flash')

        @if($posts->count() > 0)
        @include('partials.posts.posts', array('posts'=>$posts))
        @endif

    </div>     
    @include('partials.ticker.ticker')
   </div>
    {{dd($riotNotifications)}}


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