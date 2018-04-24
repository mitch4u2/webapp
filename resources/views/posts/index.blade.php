@extends ("layouts.app") 
@section ('content')
<h1>Posts</h1>
<div id="createpost"></div>
@if(count($posts)>0)
    @foreach($posts as $post)
    <div class="well">
        <div class="row">
            <div class="col-md-4 col-sm-6">
            <img style="width:100%"  src="/storage/cover_image/{{$post->cover_image}}" alt="">
            </div>
            @if(!Auth::guest())
<button type="button" data-postid="{{$post->id}}" class="btn {{ Auth::user()->favorites()->where('post_id',$post->id)->first() ? 'btn-danger' :'btn-default' }} favorite">
    <span style="pointer-events:none;"class="glyphicon glyphicon-heart"></span><b style="pointer-events:none;"> {{ Auth::user()->favorites()->where('post_id',$post->id)->first() ? 'Remove From Favorite' :'Add to Favorite' }}</b>
</button>
@endif
            <div class="col-md-8 col-sm-8">
                <h3><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></h3>
                <small>Written on {{ $post->created_at }} by {{$post->user['name']}}</small>
            </div>
        </div>
    </div>
    @endforeach
    {{ $posts->links() }}
@else
<p>NO POSTS FOUND</p>
@endif
<script>
    var token = '{{ Session::token() }}';
    var urlfavorite = '{{ route('favorite') }}';
</script>

<div id="posts"></div>
@endsection