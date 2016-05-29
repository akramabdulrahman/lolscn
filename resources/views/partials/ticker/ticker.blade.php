 <div class="chatandticker">
        <div class="tickerInfo"><div class="tikerme">Live Ticker For All Friends</div></div>
        <div class="tikerscroll">
           @foreach($currentUser->getFriends() as $friend)
            @foreach($friend->summoners()->get() as $sum)
            
           <a href="#">
                <div class="userTicker">
                    <div class="userOnlinePohoto"><img src="{{ url('/img/giveaway.png' ) }}" alt="" class="imgradiuse" width="30" height="30" /></div>
                    <div class="userTickerName">Mohammed Awad saed khalid</div>
                    <div class="userTickerTime">33 Minute ago</div>
                    <div class="userTickerDescription">with summoner <span class="important">Skt t1 Feede3r</span> at <span class="important">Eune</span> region has reach <span class="important">gold iv</span> rank from <span class="important">silver i</span></div>
                </div>
            </a>
            <div class="clear"></div>
           @endforeach
           @endforeach
        </div>
        <div class="chatInfo">
            <div class="userPhotome">
                <div class="loginuserstatus"></div>
                <img src="{{ url('/img/userPhoto.png' ) }}" alt="" width="25" height="25" />
                <div class="inputpostion"><input  id="maxsearch" type="text" class="searchinputme" placeholder="Search" /></div>
            </div>
        </div>
        <div class="chatscroll">
            @foreach($onlineFriends as $friend)
            <div class="userOnline">
                <div class="userOnlinePohoto"><img src="{{ url('/img/giveaway.png' ) }}" alt="" class="imgradiuse" width="30" height="30" /></div>
                <div class="loginuserstatus_list" style="background-color: #01e972;">{{$friend->user->name}}]</div>

                <div class="timeuser_list">Online {{ $friend->last_activity }}</div>
</div>
            </a>
            <div class="clear"></div>
            @endforeach
        </div>

    </div>
