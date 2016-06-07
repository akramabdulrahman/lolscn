@extends('layouts.home')
@section('content')
<iframe style="margin:-50px;margin-top: 126px;width: 109%;height: 700px;"  src="http://elofight.com/urf?match_id={{$match->Riot_Id}}&region={{$match->summoner()->first()->server}}"></iframe>

@endsection 