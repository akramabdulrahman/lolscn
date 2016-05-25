
@foreach ($posts as $k => $post)

@include('partials.posts.post', array('post'=>$post));

@endforeach
