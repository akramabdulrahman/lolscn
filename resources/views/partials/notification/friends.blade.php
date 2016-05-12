<div class="notebody">
    @foreach ($friendRequests as $k => $friend)
    <div class="messageshow">
        <div class="userPhoto">
            <img src="img/giveaway.png" class="imgradiuse" width="60" height="60" alt="" />
        </div>
        <div class="f_name">{{$friend->recipient()->first()->name}}</div>
        <div class="f_accountsandrecent"><span class="paddingme">100 Account</span><span class="paddingme">{{$friend->created_at->diffForHumans()}}</span></div>
        <div class="f_buttons">
            <a href="{{url('/friendship/accept/'.$friend->sender()->first()->id)}}" class="acceptbutton">✓ Aceept</a>
            <a href="{{url('/friendship/decline/'.$friend->sender()->first()->id)}}" class="declinebutton">× Decline</a>

         
        </div>
    </div>
    @endforeach
    <div class="clear"></div>

</div>