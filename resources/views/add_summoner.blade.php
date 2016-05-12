
@extends('layouts.home')
@section('content')

<div class="clear"></div>
<div class="right_ticker_chat">
   <div class="lightbox" style="width:570px;" id="x2">
            <div class="notheader">
                <div class="notheadertitle">Add New Summoner Account</div>
            </div>
            <div class="clear"></div>
            <div class="notebody2">
            <label class="col-xs-12 ">Summoner Name:</label>
            <div class="col-xs-12">
              <input class="form-control" type="text" value="">
            </div>
            <label class="col-xs-12 ">Summoner Server:</label>
            <div class="col-xs-12">
              <input class="form-control" type="text" value="">
            </div>
            <label class="col-xs-12 ">Summoner Code:</label>
            <div class="col-xs-12">
              <input class="form-control" type="text" value="12321312321321321321">
            </div>
            <label class="col-xs-12 ">HOW to verify summoner account ?</label>
            <div class="col-xs-12">
            <div class="genreateCoe">12321312321321321321</div>
            <img src="{{ url('/img/addsummoner.jpg' ) }}">   
            </div>
            <div class="col-xs-12 verfyme">
              <button type="button" class="btn btn-success">Vierfy Me</button>
            </div>
          </div>
        </div>

    <div class="leftsideprofile">

    <div class="clear"></div>
           <div class="setting_page">
             <h2> Summoner Accounts </h2>
             <hr />
             
             <ul>

             <li>
             <div class="summoenrbox">
             <div class="summonerphoot"><img src="{{ url('/img/giveaway.png' ) }}" class="imgradiuse" width="70" height="70"></div>
             <div class="summonername">SKT T1 FEED3R - PLATINUME III <Br /> North America</div>
             <div class="summonercansel">Delete</div>
             </div>
             </li>             <li>
             <div class="summoenrbox">
             <div class="summonerphoot"><img src="{{ url('/img/giveaway.png' ) }}" class="imgradiuse" width="70" height="70"></div>
             <div class="summonername">SKT T1 FEED3R - PLATINUME III <Br /> North America</div>
             <div class="summonercansel">Delete</div>
             </div>
             </li>             <li>
             <div class="summoenrbox">
             <div class="summonerphoot"><img src="{{ url('/img/giveaway.png' ) }}" class="imgradiuse" width="70" height="70"></div>
             <div class="summonername">SKT T1 FEED3R - PLATINUME III <Br /> North America</div>
             <div class="summonercansel">Delete</div>
             </div>
             </li>             <li>
             <div class="summoenrbox">
             <div class="summonerphoot"><img src="{{ url('/img/giveaway.png' ) }}" class="imgradiuse" width="70" height="70"></div>
             <div class="summonername">SKT T1 FEED3R - PLATINUME III <Br /> North America</div>
             <div class="summonercansel">Delete</div>
             </div>
             </li>             <li>
             <div class="summoenrbox">
             <div class="summonerphoot"><img src="{{ url('/img/giveaway.png' ) }}" class="imgradiuse" width="70" height="70"></div>
             <div class="summonername">SKT T1 FEED3R - PLATINUME III <Br /> North America</div>
             <div class="summonercansel">Delete</div>
             </div>
             </li>             <li>
             <div class="summoenrbox">
             <div class="summonerphoot"><img src="{{ url('/img/giveaway.png' ) }}" class="imgradiuse" width="70" height="70"></div>
             <div class="summonername">SKT T1 FEED3R - PLATINUME III <Br /> North America</div>
             <div class="summonercansel">Delete</div>
             </div>
             </li>

             </ul>
             <div class="clear"></div>

             <a href="#" data-featherlight="#x2"><div class="addmoresummoner">+</div></a>
           </div>
</div>
    
</div>

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});

    $('div.messagessend').on('keydown','#inputComment',function(event) {
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
$('.read-more-show').on('click', function(e) {
  $(this).next('.read-more-content').removeClass('hide');
  $(this).addClass('hide');
  e.preventDefault();
});

</script>
</div>
@endsection