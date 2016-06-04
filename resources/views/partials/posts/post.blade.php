
<div class="postWidget">
    <div class="postHead">
        <div class="userPhoto">
            <img src="{{ url('img/userPhoto.png') }}"  alt="userPhoto" />
        </div>
        <div class="userName">
            {{ $post->user->toString() }} <br /> <span class="nickname">{{ $post->user_id }}</span>
        </div>
        <div class="toggle">
            <img  src="{{ url('img/setting.svg') }}"  alt="moreSetting" width="15" height="15" />
            <a href='{{url('/post/delete/'.$post->id)}}'>X</a>
        </div>
    </div>
    <div class="postBody">
        {{ $post->body }}
        @if(!is_null($notif = $post->riotnotify()->first()))
        <a href="#">
            <div class="userTicker">
                <div class="userOnlinePohoto"><img src="{{ url('/img/giveaway.png' ) }}" alt="" class="imgradiuse" width="30" height="30" /></div>

                <div class="userTickerTime">{{ $notif['updated_at']->diffforhumans() }}</div>
                <div class="userTickerDescription">
                    @if($summoner = $notif->summoner()->first())
                    {!! $notif->buildMsg($notif->type,["region"=>"{$summoner->server}","sum_name"=>" <span class='important'>$summoner->name</span> ","win"=>$notif->riotable->win?"<span class='importantwin'>Win</span>":"<span class='importantlost'>Lost</span>","match_type"=>$notif->riotable->match_type,"champion_name"=>config('ritochamps.'.$notif->riotable->championId)]) !!}      
                    @endif
                    @if($notif->type=='MATCH')
                     @include('partials.riot.match', array('match'=>$notif->riotable))

                    @endif
                </div>

            </div>
        </a>
        <div class="clear"></div>
        @endif
    </div>
    <div class="postFooter">
        <div class="leftFooter" id="time{{$post->id}}">
        </div>
        <div class="rightFooter">
            <div class="shareMe">0</div>
            <div class="commentMe">0</div>
            <a href="{{ url('/likes/post/'.$post->id) }}"><div class="likeMe">{{ $post->likes->count() }}</div></a>
            <a href="{{ url('/likes/delete/post/'.$post->id) }}"><div class="">X {{ $post->likes->count() }}</div></a>
        </div>
    </div>
    <div class="commentFooter">
        <div class="numberOfComment">
            <a href="">{{ $post->comments->count() }} Comments ▼</a>
        </div>
        @foreach($post->comments as $comment)
        @if ($post->id == $comment->commentable_id)
        <div class="userComment">
            <div class="commentPhoto">
                <img src="{{ url('img/userPhoto.png') }}" width="30" height="30" alt="userPhoto" />
            </div>             
            <div class="commentUser">
                {{ $comment->user->toString() }} <span class="timecomment">{{ $comment->created_at }}</span>
            </div>
            <div class="commentBody">
                <div class="toggle">
                    <img  src="{{ url('img/setting.svg') }}"  alt="moreSetting" width="15" height="15" />
                    <a href='{{url('/comments/delete/'.$comment->id)}}'>X</a>
                </div>
                {{ $comment->body }}
                <div class="commentSocial">
                    <div class="leftFooter">
                        <a onclick="" class="showreply" data-reid="{{$comment->id}}"><div class="commentMe">&nbsp</div></a>
                        <a href="{{ url('/likes/comment/'.$comment->id) }}"><div class="likeMe">{{ $comment->likes->count() }}</div></a>
                        <a href="{{ url('/likes/delete/comment/'.$comment->id) }}"><div class="">X</div></a>

                    </div>

                </div>
            </div>
            @foreach($comment->comments as $commentoncom)
            @if($commentoncom->commentable_id == $comment->id) 
            <div class="commentOnComment">
                <div class="commentOnCommentPhoto">
                    <img src="{{ url('img/userPhoto.png') }}" width="22" height="22" alt="userPhoto" />
                </div> 
                <div class="commentUser">
                    {{ $commentoncom->user->toString() }} <span class="timecomment">{{ $commentoncom->created_at }}</span>
                </div>
                <div class="commentBody" style="padding-left: 35px;">
                    <div class="toggle">
                        <img  src="{{ url('img/setting.svg') }}"  alt="moreSetting" width="15" height="15" />
                        <a href='{{url('/comments/delete/'.$commentoncom->id)}}'>X</a>
                    </div>
                    {{ $commentoncom->body }}
                    <div class="commentSocial">
                        <div class="leftFooter">
                            <a href="{{ url('/likes/comment/'.$commentoncom->id) }}"><div class="likeMe">{{ $commentoncom->likes->count() }}</div></a>
                            <a href="{{ url('/likes/delete/comment/'.$commentoncom->id) }}"><div class="">X</div></a>

                        </div>
                    </div>
                </div>
            </div>  
            @endif
            @endforeach
            <div class="commentSocialReaply">
                <div class="clear"></div>
                <div id='showreplay' class="showreplyfor{{$comment->id}}" style="display: none; opacity:0">
                    <form  method="POST" action="{{ url('/comments/comment') }}">
                        {!! csrf_field() !!}
                        <input type="hidden" name="post_id" value="{{ $post->id }}" />
                        <input type="hidden" name="commentable_id" value="{{ $comment->id }}" />
                        <textarea class="replaycomment" id="inputComment" name="body" placeholder="Add your comment" value="{{ old('body') }}" ></textarea>
                    </form>
                </div>
            </div>
        </div>
        @endif
        @endforeach
        <div class="clear"></div>
        <form role="form" method="POST" action="{{ url('/comments/post') }}">
            {!! csrf_field() !!}
            <input type="hidden" name="commentable_id" value="{{ $post->id }}" />
            <textarea class="replaycommentOn" id="inputComment" name="body" placeholder="Add your comment" value="{{ old('body') }}" ></textarea>
        </form>

    </div>
</div>

<script type="text/javascript">
    $('div.leftFooter').ready(function () {
        var timehuman = new Date('{{ $post->created_at }}');
        var postidc = ('{{ $post->id }}');
        $("#time" + postidc).html(timeSince(timehuman));
    });


    $('div.postWidget').on('keydown', '#inputComment', function (event) {
        if (event.keyCode == 13) {
            this.form.submit()
            return false;
        }
    });

//$("form").submit(function(){
//       console.log("do ajax");
//    return false;
//});


    function timeSince(date) {

        var seconds = Math.floor((new Date() - date) / 1000);
        seconds -= (3600 * 3);
        var interval = Math.floor(seconds / 31536000);

        if (interval > 1) {
            return interval + " years ago";
        }
        interval = Math.floor(seconds / 2592000);
        if (interval > 1) {
            return interval + " months ago";
        }
        interval = Math.floor(seconds / 86400);
        if (interval > 1) {
            return interval + " days ago";
        }
        interval = Math.floor(seconds / 3600);
        if (interval > 1) {
            return interval + " hours ago";
        }
        interval = Math.floor(seconds / 60);
        if (interval > 1) {
            return interval + " minutes ago";
        }
        return Math.floor(seconds) + " seconds ago";
    }

</script>
<script type="text/javascript">
    $(".showreply").on("click", function (e) {
        var postid = $(this).attr("data-reid");
        console.log(postid);
        $(".showreplyfor" + postid).css({display: "block"}).animate({opacity: "1"});
    });
</script>

