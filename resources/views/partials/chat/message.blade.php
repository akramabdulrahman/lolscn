
<div class="message_to">
    <div class="messagesdiv">
        {!! Form::open(['route' => ['messages.update', $activethread], 'method' => 'PUT']) !!}
        {!! csrf_field() !!}
        <ul>
            @if(count($activeThreadMessages) > 0 )
            @foreach($activeThreadMessages as $message)
            <li>
                <div class="message_Body">
                    <div class= "{{  ($message->user_id==Auth::user()->id)? "message_user_photox_r" :"message_user_photox" }}"/><img class="imgradiuse" src="{{ url('/img/userPhoto.png' ) }}" alt="" width="40" height="40" />{{$message->user->name}}</div>

                <div class="messageBoxTo messageBoxFrom">  {{$message->body}}</div>
                
                <div class="messageTime">{{$message->created_at->diffForHumans()}}</div>
               
                </div>
            </li>
            @endforeach
            @endif
        </ul>
    </div>
    <div class="messagessend">
        <textarea class="reaplmesg" id="inputComment" name="body" placeholder="Add you Message" value=""></textarea>
        <input type="submit" />
        </form>
    </div>
</div>
