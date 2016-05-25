<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up Confirmation</title>
</head>
<body>
    <h1>Claim Your Summoner Now !!</h1>
 		<img src="{{ url('/img/addsummoner.jpg' ) }}">  
    <p>
        We just need you to <a href='{{ url("summoners/check/".$summoner->id) }}'>verify your the summoner {{$summoner->name}}</a> 
        by renaming one of your rune pages as [{{$summoner->token}}]
    </p>
</body>
</html>