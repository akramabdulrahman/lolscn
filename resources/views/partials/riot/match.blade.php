 <div class="clear"></div>
                <div class="postBody">
                    <div class="winPost" style='{{$match->win?"background-color:#d1eca3;":"background-color:#e2b6b3;"}}'>

                        <div class="postPadding">
                            <div class="champwithsmmoner">
                                <div class="summonerPhoto">

                                    <img src="http://ddragon.leagueoflegends.com/cdn/6.9.1/img/champion/{{config('ritochamps.'.$match->championId)}}.png" alt="" width="70" height="70">
                                </div>
                                <div class="summonerSummoner">
                                    <div class="summoner"><img src="http://ddragon.leagueoflegends.com/cdn/6.9.1/img/spell/{{config('ritospells.'.$match->spell1)}}.png" alt="" width="30" height="30"></div>
                                    <div class="summoner"><img src="http://ddragon.leagueoflegends.com/cdn/6.9.1/img/spell/{{config('ritospells.'.$match->spell2)}}.png" alt="" width="30" height="30"></div>
                                </div>
                            </div>
                            <div class="itemsSumooner">
                                <div class="itemPicked"><img src="http://ddragon.leagueoflegends.com/cdn/6.9.1/img/item/{{$match->item1}}.png" alt="" width="30" height="30"></div>
                                <div class="itemPicked"><img src="http://ddragon.leagueoflegends.com/cdn/6.9.1/img/item/{{$match->item2}}.png" alt="" width="30" height="30"></div>
                                <div class="itemPicked"><img src="http://ddragon.leagueoflegends.com/cdn/6.9.1/img/item/{{$match->item3}}.png" alt="" width="30" height="30"></div>
                                <div class="itemPicked"><img src="http://ddragon.leagueoflegends.com/cdn/6.9.1/img/item/{{$match->item4}}.png" alt="" width="30" height="30"></div>
                                <div class="itemPicked"><img src="http://ddragon.leagueoflegends.com/cdn/6.9.1/img/item/{{$match->item5}}.png" alt="" width="30" height="30"></div>
                                <div class="itemPicked"><img src="http://ddragon.leagueoflegends.com/cdn/6.9.1/img/item/{{$match->item6}}.png" alt="" width="30" height="30"></div>
                            </div>
                            <div class="trinketSummoner">
                                <img src="http://ddragon.leagueoflegends.com/cdn/6.9.1/img/item/{{$match->item7}}.png" alt="" width="30" height="30">
                            </div>
                            <div class="kdaLevelCs">
                                <div class="kda">{{$match->kills}} / <span style="color:Red;">{{$match->deaths}}</span> / {{$match->assists}}</div>
                                <div class="level">Level {{$match->level}}</div>
                                <div class="cs">CS {{$match->creeps}}</div>
                            </div>
                            <div class="sperator"></div>
                            <div class="victoryInfo">
                                <div class="victoryornot">
                                    @if($match->win)
                                    <span style='color:#4d5f2d;'>Victory</span>
                                    @else
                                    <span style='color:#8c0311;'>Defeat</span>
                                    @endif

                                </div>
                                <div class="matchtime">{{ gmdate("H:i:s", $match->duration ) }}</div>
                                <div class="matchDate">{{$match->date->diffforhumans()}}</div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>