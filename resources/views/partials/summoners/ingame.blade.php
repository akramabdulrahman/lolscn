<div class="livegame">
    <div class="liveheadgame">
        <div class="firstTeam">Blue Team</div>
        <div class="secoundTeam">Red Team</div>
    </div>
    <div class="liveInfo">
        <div class="firstLiveTeam">
            <div class="player">
                <div class="playerProfile"><img src="http://ddragon.leagueoflegends.com/cdn/6.9.1/img/champion/{{ config('ritochamps.'.$ingame['participants'][0]['championId']) }}.png" alt="moreSetting" width="40" height="40"></div>
                <div class="playerName">{{ $ingame['participants'][0]['summonerName'] }}</div>
                <div class="champioNname">{{ config('ritochamps.'.$ingame['participants'][0]['championId']) }}</div>
            </div>
            <div class="player">
                <div class="playerProfile"><img src="http://ddragon.leagueoflegends.com/cdn/6.9.1/img/champion/{{ config('ritochamps.'.$ingame['participants'][1]['championId']) }}.png" alt="moreSetting" width="40" height="40"></div>
                <div class="playerName">{{ $ingame['participants'][1]['summonerName'] }}</div>
                <div class="champioNname">{{ config('ritochamps.'.$ingame['participants'][1]['championId']) }}</div>
            </div>
            <div class="player">
                <div class="playerProfile"><img src="http://ddragon.leagueoflegends.com/cdn/6.9.1/img/champion/{{ config('ritochamps.'.$ingame['participants'][2]['championId']) }}.png" alt="moreSetting" width="40" height="40"></div>
                <div class="playerName">{{ $ingame['participants'][2]['summonerName'] }}</div>
                <div class="champioNname">{{ config('ritochamps.'.$ingame['participants'][2]['championId']) }}</div>
            </div>
            <div class="player">
                <div class="playerProfile"><img src="http://ddragon.leagueoflegends.com/cdn/6.9.1/img/champion/{{ config('ritochamps.'.$ingame['participants'][3]['championId']) }}.png" alt="moreSetting" width="40" height="40"></div>
                <div class="playerName">{{ $ingame['participants'][3]['summonerName'] }}</div>
                <div class="champioNname">{{ config('ritochamps.'.$ingame['participants'][3]['championId']) }}</div>
            </div>
            <div class="player">
                <div class="playerProfile"><img src="http://ddragon.leagueoflegends.com/cdn/6.9.1/img/champion/{{ config('ritochamps.'.$ingame['participants'][4]['championId']) }}.png" alt="moreSetting" width="40" height="40"></div>
                <div class="playerName">{{ $ingame['participants'][4]['summonerName'] }}</div>
                <div class="champioNname">{{ config('ritochamps.'.$ingame['participants'][4]['championId']) }}</div>
            </div>
        </div>
        <div class="centerBox">
            <div class="matchNmae">{{ config('ritocurrmatchtypes.'.$ingame['gameQueueConfigId']) }}</div>
            <div class="matchTime" data-matchtime='{{ $ingame['gameStartTime'] }}'></div>
            <div class="matchBUtoon">Live</div>
        </div>
    </div>
    <div class="secoundLiveTeam">
        <div class="player">
            <div class="playerProfile"><img src="http://ddragon.leagueoflegends.com/cdn/6.9.1/img/champion/{{ config('ritochamps.'.$ingame['participants'][5]['championId']) }}.png" alt="moreSetting" width="40" height="40"></div>
            <div class="playerName">{{ $ingame['participants'][5]['summonerName'] }}</div>
            <div class="champioNname">{{ config('ritochamps.'.$ingame['participants'][5]['championId']) }}</div>
        </div>
        <div class="player">
            <div class="playerProfile"><img src="http://ddragon.leagueoflegends.com/cdn/6.9.1/img/champion/{{ config('ritochamps.'.$ingame['participants'][6]['championId']) }}.png" alt="moreSetting" width="40" height="40"></div>
            <div class="playerName">{{ $ingame['participants'][6]['summonerName'] }}</div>
            <div class="champioNname">{{ config('ritochamps.'.$ingame['participants'][6]['championId']) }}</div>
        </div>
        <div class="player">
            <div class="playerProfile"><img src="http://ddragon.leagueoflegends.com/cdn/6.9.1/img/champion/{{ config('ritochamps.'.$ingame['participants'][7]['championId']) }}.png" alt="moreSetting" width="40" height="40"></div>
            <div class="playerName">{{ $ingame['participants'][7]['summonerName'] }}</div>
            <div class="champioNname">{{ config('ritochamps.'.$ingame['participants'][7]['championId']) }}</div>
        </div>
        <div class="player">
            <div class="playerProfile"><img src="http://ddragon.leagueoflegends.com/cdn/6.9.1/img/champion/{{ config('ritochamps.'.$ingame['participants'][8]['championId']) }}.png" alt="moreSetting" width="40" height="40"></div>
            <div class="playerName">{{ $ingame['participants'][8]['summonerName'] }}</div>
            <div class="champioNname">{{ config('ritochamps.'.$ingame['participants'][8]['championId']) }}</div>
        </div>
        <div class="player">
            <div class="playerProfile"><img src="http://ddragon.leagueoflegends.com/cdn/6.9.1/img/champion/{{ config('ritochamps.'.$ingame['participants'][9]['championId']) }}.png" alt="moreSetting" width="40" height="40"></div>
            <div class="playerName">{{ $ingame['participants'][9]['summonerName'] }}</div>
            <div class="champioNname">{{ config('ritochamps.'.$ingame['participants'][9]['championId']) }}</div>
        </div>
    </div>
    <div class="clear"></div>
</div>
<div class="clear"></div>

<script>
    $('document').ready(function () {
        function addZero(x, n) {
            while (x.toString().length < n) {
                x = "0" + x;
            }
            return x;
        }
        function timestampToCounter($stamp) {
            console.log($stamp);
            totalSeconds = $stamp;
            timestamp = Math.floor(Date.now() / 1000);
            totalSeconds = timestamp - totalSeconds;
            hours = Math.floor(totalSeconds / 3600);
            totalSeconds %= 3600;
            minutes = Math.floor(totalSeconds / 60);
            seconds = Math.floor(totalSeconds % 60);

            return (addZero(hours, 2) + ":" + addZero(minutes, 2) + ":" + addZero(seconds, 2));
        }

        setInterval( function () {
            $matchTime = $('.matchTime');
            $stamp = ($matchTime.attr('data-matchtime'));
            
            $matchTime.text(timestampToCounter(Math.floor($stamp / 1000)));
        },1000);

    });

</script>