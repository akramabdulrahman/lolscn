
<div class="notebody">

    @forelse($unseenMessages as $thread)
    @if($message = $thread->getLatestMessageAttribute())
    <div class="messageshow">
        <div class="userPhoto">
            <img src="img/giveaway.png" class="imgradiuse" width="60" height="60" alt="" />
        </div>
        <a href='{{url('messages/'.$thread->id)}}'>
            <div class="f_name"><span class="paddingmem">{{$message->user()->first()->name}}</span><span class="paddingmem1">{{$thread->updated_at->diffForHumans()}}</span></div>
            <div class="m_accountsandrecent">{{str_limit($message->body, 50,' ...')}}</div>
        </a>
    </div>
    <div class="clear"></div>
    @endif
    @empty
    <p>No users</p>
    @endforelse


</div>