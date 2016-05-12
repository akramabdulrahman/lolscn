
<div class="fixed_notifcation">
    <ul>

    <li>
    @if(($count = $pendingFriendShips->count())!=0 )
    <a href="#" data-toggle="tooltip" data-placement="right" title="Friends" data-featherlight="#fl1"><div class="not_frnd">
            <div class="puget">{{ $count  }}</div></div></a>
     @else
            <div class="not_frnd"> </div>
     @endif 
     </li>      
    <li><a href="#" data-toggle="tooltip" data-placement="right" title="Messages" data-featherlight="#fl2"><div class="not_msg"><div class="puget">99</div></div></a></li>
    <li><a href="#" data-toggle="tooltip" data-placement="right" title="Notifcations" data-featherlight="#fl3"><div class="not_bell"><div class="puget">99</div></div></a></li>
    </ul>
        <div class="lightbox" id="fl1">
            <div class="notheader">
                <div class="notheadertitle">Friends</div>
            </div>
            <div class="clear"></div>
            <div class="notebody">
            @foreach ($pendingFriendShips as $k => $friend)
            <div class="messageshow">
            <div class="userPhoto">
                <img src="img/giveaway.png" class="imgradiuse" width="60" height="60" alt="" />
            </div>
            <div class="f_name">{{ $friend->user()->firstname }}</div>
            <div class="f_accountsandrecent"><span class="paddingme">100 Account</span><span class="paddingme">2 Days Ago</span></div>
            <div class="f_buttons">

        <form role="form" method="POST" action="{{ url('/friend/accept') }}">
            {!! csrf_field() !!}
            <input type="hidden" name="other_friend" value="{{ $friend->user()->id }}" />
            <input type="submit" class="acceptbutton" value="✓ Aceept" />
        </form>
                <a href=""><div class="declinebutton">× Decline</div></a>
            </div>
            </div>
            <div class="clear"></div>
            @endforeach
            </div>
        </div>
</div>
