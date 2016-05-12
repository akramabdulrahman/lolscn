<div class="list_message_user">
    <ul>
        @if($threads->count()) 
        @foreach($threads as $thread) 
        <li style="{{($thread->id == $activethread)?"background-color:#333":""}}">
            <a href="{{url('messages/'.$thread->id)}}">
                <div class="message_user_photo"><img class="imgradiuse" src="{{ url('/img/userPhoto.png' ) }}" alt="" width="40" height="40" /></div>
                <div class="message_user_name">{{$thread->participantsString(Auth::id())}}</div>

                <div class="m_accountsandrecent">{{ ($thread->getLatestMessageAttribute()->body) }}</div>
                <div class="message_user_time"></div>
                <div class="clear"></div>
            </a>
        </li>
        @endforeach
        @endif
    </ul>
</div>