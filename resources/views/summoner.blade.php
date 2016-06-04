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
        <div class="profile_main">             

            <div class="profile_cover" style="background-image: url('http://ddragon.leagueoflegends.com/cdn/img/champion/splash/{{config((!empty($summoner->matches->toArray()))?'ritochamps.'.$summoner->matches[0]['championId']:103)}}_0.jpg');"></div>
            <div class="profile_image"><img src="http://ddragon.leagueoflegends.com/cdn/6.10.1/img/profileicon/{{$summoner->Icon}}.png" alt="" width="100" height="100" class="imgradiuse"></div>

            @if(empty($summoner->users->toArray()))
            <a href="{{url('summoners/verify/'.$summoner->server.'/'.$summoner->name)}}"><div class="profile_sendmessag"><span class="send_message_prfoile">Verify</span></div></a>
            @else
            <a href="{{url('profile/'.$summoner->users[0]->id)}}"><div class="profile_sendmessag"><span class="send_message_prfoile">Verified</span></div></a>

            @endif
            <a href="{{url('summoners/ingame/'.$summoner->id)}}"><div class="profile_sendmessag"><span class="send_message_prfoile">In Game ?</span></div></a>

            <div class="profile_name">{{$summoner->name}}<br>Level {{$summoner->lvl}}</div>
            <a href="{{url('summoners/update/'.$summoner->id)}}"><div class="profile_addfriend"><span class="addfriend_prfoile">Update</span></div></a>
            <div class="clear"></div>
            @include('flash')

            @if(!is_null($summoner->rank))
            <div class="ranksummary">
                <div class="rankimage">
                    <img src="{{url("tier-icons/".strtolower(str_replace(' ','_',array_values(config('ritoranks'))[array_search($summoner->rank->new_rank, array_column(config('ritoranks'), 'elo'))]['name'])).".png")}}" width="117" height="117" alt="" />
                </div>
                <div class="rankinfo">
                    <div class="inforank">
                        {{ $ritoRanks =  array_values(config('ritoranks'))[array_search($summoner->rank->new_rank, array_column(config('ritoranks'), 'elo'))]['name']}}
                        <br />
                        {{$summoner->league->leaguepts}} LP
                        <br />	
                        Win Ratio {{intval(($summoner->league->wins/($summoner->league->wins+$summoner->league->losses))*100)}}%
                        <br />
                        {{$summoner->league->queue_name}}
                        <br />
                    </div>
                    <div class="circlerank">
                        <div class="c100 p{{intval(($summoner->league->wins/($summoner->league->wins+$summoner->league->losses))*100)}} small green">
                            <span>{{intval(($summoner->league->wins/($summoner->league->wins+$summoner->league->losses))*100)}}%</span>
                            <div class="slice">
                                <div class="bar"></div>
                                <div class="fill"></div>
                            </div>
                        </div>	
                    </div>
                    <div class="winlsoerank">
                        <span style="color:#91c46b;">Wins {{$summoner->league->wins }}</span>
                        <br />
                        <span style="color:#c46b6d;">losses {{$summoner->league->losses}}</span>
                    </div>
                </div>
                <div class="rankfiliter">
                    {{Form::open(['method'=>'GET'])}}
                    <ul>
                        <li>
                            <select title="Select win" name="win"  data-live-search="false" data-size="5" data-width="150px" class="selectpicker">
                                <option class="bs-title-option" value=''>Game Finish</option>
                                <option label="la-en" value="1" {{ (old("win")) ? "selected":"" }} data-content="<img class='img-circle' src='http://ddragon.leagueoflegends.com/cdn/img/champion/splash/Aatrox_0.jpg' width='20' height='20' alt='Victory' /> Victory"></option> 
                                <option label="la-en" value="0" {{ (old("win"))  ? "selected":"" }} data-content="<img class='img-circle' src='http://ddragon.leagueoflegends.com/cdn/img/champion/splash/Aatrox_0.jpg' width='20' height='20' alt='Deafate' /> Deafate"></option> 
                            </select>
                        </li>
                        <li>
                            <select title="Select champ" name="champ" data-live-search="true" value='{{old('champ')}}' data-size="5" data-width="150px" class="selectpicker">
                                <option class="bs-title-option" value='' >All Champions</option>
                                @foreach(config('ritochamps') as $key=>$champ)
                                <option label="la-en" value="{{$key}}" {{ (old("champ")== $key)  ? "selected":"" }} data-content="<img class='img-circle' src='http://ddragon.leagueoflegends.com/cdn/6.9.1/img/champion/{{($champ)}}.png' width='20' height='20' alt='{{($champ)}}' /> {{($champ)}}"></option> 
                                @endforeach
                            </select>
                        </li>
                        <li>
                            <select title="Select match type" name="match_type" data-live-search="false" value='{{old('match_type')}}' data-size="5" data-width="150px" class="selectpicker">
                                <option class="bs-title-option" value=''>Queue Type</option>
                                @foreach(config('ritomatchtypes') as $key=>$type)

                                <option label="la-en" value="{{$type}}" {{ (old("match_type")== $type)  ? "selected":"" }} data-content="<img class='img-circle' src='http://ddragon.leagueoflegends.com/cdn/img/champion/splash/Aatrox_0.jpg' width='20' height='20' alt='English' /> {{str_replace('_',' ',$type)}}"></option> 
                                @endforeach
                            </select>
                        </li>
                    </ul>
                    <input type='submit' /> 
                    {{Form::close()}}
                </div>
            </div>
            @endif
            <div class="clear"></div>
            <div id="summary">
                @if(Session::has('ingame'))
                 @include('partials.summoners.ingame',array('ingame'=>Session::get('ingame')))
                @endif
                <div class="clear"></div>

                @foreach($matches as $match)
                    @include('partials.riot.match',array('match'=>$match))
                @endforeach     
            </div>  
        </div>

    </div>
    @stop