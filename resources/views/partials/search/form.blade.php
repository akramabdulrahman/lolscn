
{{Form::open(['url'=>url('/search'),'method'=>'GET'])}}
<input type="text" id="box" class="search_style" name="query" placeholder="Enter the summoner's name." />
<button type="submit" id="box2" class="search_button"><img style="width:22px;height: 22px;" src="img/search.svg" alt="Search"></button>
{{Form::close()}}