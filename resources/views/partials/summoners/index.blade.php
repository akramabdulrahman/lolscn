
             <ul>

            @foreach($summoners as $summoner)
                @include('partials.summoners.summoner', array('summoner'=>$summoner))
            @endforeach

             </ul>
             