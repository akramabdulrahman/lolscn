<li>
    <div class="summoenrbox">
        <div class="summonerphoot"><img src="{{ url('/img/giveaway.png' ) }}" class="imgradiuse" width="70" height="70"></div>
        <div class="summonername">{{$summoner->name}} - 
            {{array_values(config('ritoranks'))[array_search($summoner->rank->new_rank, array_column(config('ritoranks'), 'elo'))]['name']}}
            <Br /> {{config('ritosvrs.'.$summoner->server.'.name')}}</div>
        <div class="summonercansel">Delete</div>
    </div>
</li>       
