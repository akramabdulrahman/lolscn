
@extends('layouts.home')
@section('content')

<div class="clear"></div>
<div class="right_ticker_chat">
    <div class="lightbox" style="width:570px;" id="x2">
        <div class="notheader">
            <div class="notheadertitle">Add New Summoner Account</div>
        </div>
        <div class="clear"></div>
        <form method='post' action='{{url('summoners/verify/')}}'>
            {!! csrf_field() !!}

            <div class="notebody2">
                <label class="col-xs-12 ">Summoner Name:</label>
                <div class="col-xs-12">
                    <input class="form-control" name="name" type="text" value="">
                </div>
                <label class="col-xs-12 ">Summoner Server:</label>
                <div class="col-xs-12">
                    <select title="Select champ" name="server" data-live-search="true" value='{{old('server')}}' data-size="5" data-width="220px" class="selectpicker">
                        <option class="bs-title-option" value='' >Choose Summoner's Region</option>
                        @foreach(config('ritosvrs') as $key=>$value)
                        <option label="la-en" value="{{$key}}" {{ (old("server")== $key)  ? "selected":"" }} data-content="<img class='img-circle' src='http://www.wadymasr.com/YouCanDoIt/img/regions/s6.png' width='20' height='20' alt='{{($value['name'])}}' /> {{($value['name'])}}"></option> 
                        @endforeach
                    </select>      
                </div>

                <label class="col-xs-12 ">HOW to verify summoner account ?</label>
                <label class="col-xs-12 ">As Soon As You Hit The Verify Button, We will Send you an 
                    Email contining a token , rename one of your rune pages with it , press verify on the summoner page and you're done
                </label>

                <div class="col-xs-12">
                    <div class="genreateCoe">12321312321321321321</div>
                    <img src="{{ url('/img/addsummoner.jpg' ) }}">   
                </div>
                <div class="col-xs-12 verfyme">
                    <button type="submit" class="btn btn-success">Vierfy</button>
                </div>
            </div>
        </form>
    </div>

    <div class="leftsideprofile">

        <div class="clear"></div>
        <div class="setting_page">
            <h2> Summoner Accounts </h2>
            <hr />
            @include('partials.summoners.index',array('summoners'=>$summoners))
            <div class="clear"></div>

            <a href="#" data-featherlight="#x2"><div class="addmoresummoner">+</div></a>
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
    })
    $('.selectpicker').on('click','.notheader',function(){
        console.log('a8a');
        this.selectpicker('refresh');
    });

    ;
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