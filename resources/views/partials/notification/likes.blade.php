<div class="notebody">
    @foreach($notifications as $notif)
    @if($notif->notification_type ==1)
    <a href="{{url('posts/'.$notif->notifyable()->first()->id)}}" > <div class="messageshow">
            <div class="userPhoto">
                <img src="img/giveaway.png" class="imgradiuse" width="60" height="60" alt="" />
            </div>
            <div class="s_accountsandrecent"><b>{{$notif->user()->first()->name}}</b> Liked a Post <span class="paddingmem2">{{$notif->created_at->diffforhumans()}}</span></div>
        </div>
    </a>
    <div class="clear"></div>

    @elseif($notif->notification_type ==2)
       <a href="{{url('posts/'.$notif->notifyable()->first()->id)}}" > <div class="messageshow">
            <div class="userPhoto">
                <img src="img/giveaway.png" class="imgradiuse" width="60" height="60" alt="" />
            </div>
            <div class="s_accountsandrecent"><b>{{$notif->user()->first()->name}}</b> Commented on Post <span class="paddingmem2">{{$notif->created_at->diffforhumans()}}</span></div>
        </div>
    </a>
    <div class="clear"></div>
    @elseif($notif->notification_type ==3)
    
         <a href="{{url('posts/'.$notif->notifyable()->first()->id)}}" > <div class="messageshow">
            <div class="userPhoto">
                <img src="img/giveaway.png" class="imgradiuse" width="60" height="60" alt="" />
            </div>
            <div class="s_accountsandrecent"><b>{{$notif->user()->first()->name}}</b> Replied to your comment on Post <span class="paddingmem2">{{$notif->created_at->diffforhumans()}}</span></div>
        </div>
    </a>
    <div class="clear"></div
    @elseif($notif->notification_type ==4)
         <a href="{{url('posts/'.$notif->notifyable()->first()->id)}}" > <div class="messageshow">
            <div class="userPhoto">
                <img src="img/giveaway.png" class="imgradiuse" width="60" height="60" alt="" />
            </div>
            <div class="s_accountsandrecent"><b>{{$notif->user()->first()->name}}</b> Shared your Post <span class="paddingmem2">{{$notif->created_at->diffforhumans()}}</span></div>
        </div>
    </a>
    <div class="clear"></div
    @endif

    @endforeach

</div>

