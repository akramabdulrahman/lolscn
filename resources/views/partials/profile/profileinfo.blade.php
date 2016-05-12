
@extends('layouts.home')
@section('content')

<div class="clear"></div>
<div class="right_ticker_chat">

    <div class="leftsideprofile">

        <div class="clear"></div>
        <div class="setting_page">
            <h2> About </h2>

            <h4> Contact Information </h4>

            <ul>
                @if($currentUser->mobile)    
                <li>
                    Mobile : {{$currentUser->mobile}}
                </li>
                @endif

                <li>
                    Email : {{$currentUser->email}}
                </li>
            </ul>

            <h4> Personal Information </h4>

            <ul>
                @if($currentUser->country_id)
                <li>
                    Country : {{$currentUser->country()->first()->name}}
                </li>
                @endif
                @if($currentUser->bod)
                <li>
                    Birthday : {{$currentUser->bod->toDateString()}}
                </li>
                @endif
            </ul>

            @if($currentUser->facebook_id or $currentUser->google_id)
            <h4> Social Information </h4>

            <ul>
                @if($currentUser->facebook_id)
                <li>
                    <a href=" https://www.facebook.com/{{$currentUser->facebook_id}}">Facebook</a>
                </li>
                @endif
                @if($currentUser->google_id)
                <li>
                    <a href=" https://plus.google.com/{{$currentUser->google_id}}/posts">GooglePlus</a>
                </li>
                @endif
            </ul>
            @endif
            

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