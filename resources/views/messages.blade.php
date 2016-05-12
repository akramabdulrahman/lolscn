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
  
        <div class="clear"></div>

        <div class="leftsideprofile">
            <div class="mymessage">

                @include('partials.chat.activethreads', array('threads'=>$threads,'activethread'=>$activethread))
                @include('partials.chat.message', array('activeThreadMessages'=>$activeThreadMessages,'activethread'=>$activethread))
                
            </div>
        </div>
    </div>
</div>
@endsection
