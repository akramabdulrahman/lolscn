
@extends('layouts.home')
@section('content')

<div class="clear"></div>
<div class="right_ticker_chat">

    <div class="leftsideprofile">
        <div class="searchResultbox">
            <div class="selectItems">
                <ul id="menu">
                    <li class="{{($cond = is_null($search['filter']))?'menu-selected':''}}">
                        <a style="{{$cond?'color: white;background-color: #455a64; border-radius: 5px;':''}}" href="{{url('/search')}}?query={{$search['query']}}">ALL</a>
                    </li>
                    <li  class="{{(($cond=$search['filter']=='users'))?'menu-selected':''}}"><a style="{{$cond?'color: white;background-color: #455a64; border-radius: 5px;':''}}" href="{{url('/search/users')}}?query={{$search['query']}}" >Profile</a></li>
                    <li class="{{(($cond=$search['filter']=='summoners'))?'menu-selected':''}}"><a style="{{$cond?'color: white;background-color: #455a64; border-radius: 5px;':''}}" href="{{url('/search/summoners')}}?query={{$search['query']}}">Summoners</a></li>
                    <li class="{{(($cond=$search['filter']=='champions'))?'menu-selected':''}}"><a style="{{$cond?'color: white;background-color: #455a64; border-radius: 5px;':''}}" href="{{url('/search/champions')}}?query={{$search['query']}}">Champions</a></li></ul>
            </div>
            <div class="clear"></div>
            <ul style="padding: 10px;">



                @if(!empty( $search['results']['summoners']))
                <h2>Summoners</h2>
                @foreach($search['results']['summoners'] as $key=>$value)
                <div class='summoners-results'>
                    <li>
                        <div class="summoenrbox">
                            <div class="summonerphoto"><img src="http://ddragon.leagueoflegends.com/cdn/6.10.1/img/profileicon/{{$value->Icon}}.png" alt="" width="70" height="70" class="imgradiuse"></div>
                            <div class="summonername"><a href="{{url('/summoners/'.$value->id)}}">{{$value->name}}</a> - {{ (!is_null($value->rank))?array_values(config('ritoranks'))[array_search($value->rank->new_rank, array_column(config('ritoranks'), 'elo'))]['name']:'user unranked'}} <br> {{config('ritosvrs.'.$value->server.'.name')}}</div>
                        </div>
                    </li>
                </div>
                <div class="clear"></div>

                @endforeach
                @endif
                <div class="clear"></div>
                @if(!empty( $search['results']['profiles']))
                <h2>Users</h2>
                @foreach($search['results']['profiles'] as $key=>$value)
                <div class='users-results'>
                    <li>
                        <div class="summoenrbox">
                            <div class="summonerphoto"><img src="{{url('images/profile/'.$value->id)}}" alt="" width="70" height="70" class="imgradiuse"></div>
                            <div class="summonername"><a href="{{url('/profile/'.$value->id)}}">{{$value->name}}</a> {{($count = $value->summoners->count())>0?'-'.$count:''}}<a href="{{url('/profile/'.$value->id.'/summoners')}}">summoners</a></div>
                        </div>
                    </li>
                </div>
                <div class="clear"></div>
                @endforeach
                @endif
                <div class="clear"></div>

            </ul>
            <div class="clear"></div>    
        </div>
    </div>

</div>

<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    $('div.messagessend').on('keydown', '#inputComment', function (event) {
        if (event.keyCode == 13) {
            this.form.submit()
            return false;
        }
    });
</script>


<script>
    $(".showreply").on("click", function (e) {
        var postid = $(this).attr("data-reid");
        console.log(postid);
        $(".showreplyfor" + postid).css({display: "block"}).animate({opacity: "1"});
    });

    // Hide the extra content initially, using JS so that if JS is disabled, no problemo:
    $('.read-more-content').addClass('hide')

// Set up a link to expand the hidden content:
            .before('<a class="read-more-show colorclass" href="#">Read More</a>')

// Set up the toggle effect:
    $('.read-more-show').on('click', function (e) {
        $(this).next('.read-more-content').removeClass('hide');
        $(this).addClass('hide');
        e.preventDefault();
    });

</script>
</div>
@endsection