<form role="form" method="POST" action="{{ url('/post') }}">
    <div class="postFeeds">
        <div class="feedPost">
            {!! csrf_field() !!}
            <textarea placeholder="Think Like Teemo !" name="body" value="{{ old('body') }}" class="whatyouthink"></textarea>
            <div class="upladoImage"><input type="file" name="upload"/></div>
            <div class="postButton">
                <button type="submit" class="pushButton">Post</button>
            </div>
        </div>
    </div>
</form>