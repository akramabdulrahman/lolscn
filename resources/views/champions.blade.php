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
            <div class="profile_cover" style="background-image: url('http://ddragon.leagueoflegends.com/cdn/img/champion/splash/{{config('ritochamps.'.$summoner->matches[0]['championId'])}}_0.jpg');"></div>
            <div class="profile_image"><img src="http://ddragon.leagueoflegends.com/cdn/6.10.1/img/profileicon/{{$summoner->Icon}}.png" alt="" width="100" height="100" class="imgradiuse"></div>

            @if(empty($summoner->users->toArray()))
            <a href="{{url('summoners/verify/'.$summoner->server.'/'.$summoner->name)}}"><div class="profile_sendmessag"><span class="send_message_prfoile">Verify</span></div></a>
            @else
            <a href="{{url('profile/'.$summoner->users[0]->id)}}"><div class="profile_sendmessag"><span class="send_message_prfoile">Verified</span></div></a>

            @endif
            <a href="{{url('summoners/ingame/'.$summoner->id)}}"><div class="profile_sendmessag"><span class="send_message_prfoile">In Game ?</span></div></a>

            <div class="profile_name">{{$summoner->name}}<br>Level {{$summoner->lvl}}</div>
            <a href=""><span class="addfriend_prfoile">Update</span></a>
            <a href="{{url('summoners/champions/'.$summoner->id)}}"><span class="addfriend_prfoile">Public stats</span></a>

        </div>
        <div class="clear"></div>
        @include('flash')
        <div class="clear"></div>

        <div class="championranks">
            <div class="circle_season">
                <ul>
                    @foreach(config('ritoseasons') as $key=>$s )
                    <li><a href="http://lolscn.dev/summoners/champions/{{$summoner->id}}/{{$s}}"><div class="c1 {{($s==$season)?'selectedx1':''}}">S{{$key+1}}</div></a></li>
                    @endforeach
                </ul>
            </div>
            <div class="clear"></div>
            <table class="table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th colspan="2">Champion Info</th>
                        <th>Played</th>
                        <th>Kills</th>
                        <th>Death</th>
                        <th>Assist</th>
                        <th>KDA</th>
                        <th>Golds</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($wariors['champions'] as $key => $value)
                    @if($value['id'] != 0)
                    <tr class="yellow">
                        <td>{{ $key + 1 }}</td>
                        <td colspan="2">
                            <div class="chmpionsimg"><img src="http://ddragon.leagueoflegends.com/cdn/6.10.1/img/champion/{{config('ritochamps.'.$value['id'])}}.png" alt="" width="25" height="25"></div><div class="champioNname">{{config('ritochamps.'.$value['id'])}}</div></td>
                        <td><span style="color:#2d8ac8;">Win - ({{$value['stats']['totalSessionsWon']}}) </span><span style="color:black;">|</span> <span style="color:#ce3728;">Lost - ({{$value['stats']['totalSessionsLost']}})</span><span data-uk-tooltip="" title="" style="color: #989898; float:right;">{{  round($value['stats']['totalSessionsWon']/$value['stats']['totalSessionsPlayed'],2) * 100 }}%</span></td>
                        <td><span style="color: #16A085;">{{ round($value['stats']['totalChampionKills']/$value['stats']['totalSessionsPlayed'],2) }}</span></td>
                        <td><span style="color: #ce3728;">{{ round($value['stats']['totalDeathsPerSession']/$value['stats']['totalSessionsPlayed'],2)}}</span></td>
                        <td><span style="color: #F39C12;">{{ round($value['stats']['totalAssists']/$value['stats']['totalSessionsPlayed'],2) }}</span></td>
                        @if ($value['stats']['totalDeathsPerSession'] == 0)
                        <td><span style="color:#989898;">0.00:1</span></td>
                        @else
                        <td><span style="color:#989898;">{{ round(($value['stats']['totalChampionKills'] + $value['stats']['totalAssists'])/$value['stats']['totalDeathsPerSession'],2) }}:1</span></td>
                        @endif                    
                        <td><span style="color: #E67E22;">{{Helpers::custom_number_format($value['stats']['totalGoldEarned'])}}</span></td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    @stop