<div class="chatandticker">
    <div class="tickerInfo"><div class="tikerme">Live Ticker For All Friends</div></div>
    <div class="tikerscroll">
        @foreach($riotNotifications as $key => $value)
        <a href="#">
            <div class="userTicker">
                <div class="userOnlinePohoto"><img src="{{ url('/img/giveaway.png' ) }}" alt="" class="imgradiuse" width="30" height="30" /></div>
                <div class="userTickerName">{{ $value->summoner()->first()->users()->first()->toString() }}</div>
                <div class="userTickerTime">{{ $value['updated_at']->diffforhumans() }}</div>
                <div class="userTickerDescription">
                    @if($summoner = $value->summoner()->first())
                    @if ($value->type == "MATCH")
                    @if ($value->riotable->in_game == 1)
                    {!! $value->buildMsg("IN_GAME",["region"=>"{$summoner->server}","sum_name"=>" <span class='important'>$summoner->name</span>","match_type"=>config('ritocurrmatchtypes.'.$value->riotable->match_type),"champion_name"=>config('ritochamps.'.$value->riotable->championId)]) !!}      
                    @else
                    {!! $value->buildMsg($value->type,["region"=>"{$summoner->server}","sum_name"=>" <span class='important'>$summoner->name</span> ","win"=>$value->riotable->win?"<span class='importantwin'>Win</span>":"<span class='importantlost'>Lost</span>","match_type"=>$value->riotable->match_type,"champion_name"=>config('ritochamps.'.$value->riotable->championId)]) !!}      
                    @endif
                    @endif
                    @if ($value->type == "RANK")
                    {!! 
                    $value->buildMsg($value->type,
                    ["region"=>$summoner->server,
                    "sum_name"=> " <span class='important'>$summoner->name</span> ",
                    "downorup"=>" <span class='important'>{$value->riotable->type}</span>",
                    "last_rank"=>str_replace(' ','_',array_values(config('ritoranks'))[array_search($value->riotable->last_rank, array_column(config('ritoranks'), 'elo'))]['name']),
                    "new_rank"=>str_replace(' ','_',array_values(config('ritoranks'))[array_search($value->riotable->new_rank, array_column(config('ritoranks'), 'elo'))]['name'])
                                        ])
                    !!}                 
                    @endif

                    @endif

                </div>
            </div>
        </a>
        <div class="clear"></div>
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
