@extends ("layouts.app") 
@section ('content')
<a href="/posts" class="btn btn-default">GO BACK</a>
<h1>{{$post->title}}</h1>
<img style="width:100%" src="/storage/cover_image/{{$post->cover_image}}" alt="">
<br><br>
<div>
    {!!$post->body!!}
</div>
<hr>
<small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
<hr> @if(!Auth::guest()) @if(Auth::user()->id == $post->user_id)
<a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a> {!!Form::open(['action'=>['PostsController@destroy',$post->id],'method'=>'POST','class'=>'pull-right'])!!}
{{Form::hidden('_method','DELETE')}} {{Form::submit('Delete', ['class' => 'btn btn-danger'])}} {!!Form::close()!!} @endif
@endif



<div class="container">
    <div class="row">

        <div class="col-sm-8">
            <div class="panel panel-white post panel-shadow">
                <div class="post-description">
                    {!! Form::open(['action'=> 'CommentsController@store','method'=>'POST']) !!}
                    <div class="form-group">
                        {{Form::textarea('body','',['rows'=>'5', 'id'=>'comment', 'class'=>'form-control','placeholder'=>'Write a comment here'])}}
                        <input name="post_id" type="hidden" value="{{$post->id}}"> {{-- <textarea name="body" class="form-control"
                            rows="5" id="comment"></textarea> --}}
                    </div>
                    {{Form::submit('comment', ['class'=> 'btn btn-primary pull-right'])}} {!! Form::close() !!}
                    <br><br>
                </div>
            </div>
        </div>

        @if(count($comments)>0) @foreach($comments as $comment)
        <div class="col-sm-8">
            <div class="panel panel-white post panel-shadow">
                <div class="post-heading">
                    <div class="pull-left image">
                        <img src="/storage/profile_image/{{$comment->user['profile_image']}}" class="img-circle avatar" alt="user profile image">
                    </div>
                    <div class="pull-left meta">
                        <div class="title h5">
                            <a href="#"><b>{{ $comment->user['name']}}</b></a> made a post.
                        </div>
                        <h6 class="text-muted time">{{ $comment->created_at}}</h6>
                    </div>
                    @if(!Auth::guest()) @if(Auth::user()->id == $comment->user_id) {!!Form::open(['action'=>['CommentsController@destroy',$comment->id],'method'=>'POST','class'=>'pull-right'])!!}
                    {{Form::hidden('_method','DELETE')}} {{Form::submit('Delete', ['class' => 'btn btn-danger'])}} {!!Form::close()!!}
                    @endif @endif
                </div>
                <div class="post-description">
                    <p>{{ $comment->body}}</p>
                    <div class="stats" data-commentid="{{$comment->id}}">
                        <a class="btn {{ Auth::user()->likes()->where('comment_id',$comment->id)->first() ? Auth::user()->likes()->where('comment_id',$comment->id)->first()->like_dislike == 1 ? 'btn-primary' : 'btn-default' : 'btn-default' }} stat-item like">
                        <i class="fa fa-thumbs-up icon"></i><span>0</span>
                    </a>
                        <a class="btn {{ Auth::user()->likes()->where('comment_id',$comment->id)->first() ? Auth::user()->likes()->where('comment_id',$comment->id)->first()->like_dislike == 0 ? 'btn-primary' : 'btn-default' : 'btn-default' }} stat-item like">
                        <i class="fa fa-thumbs-down icon"></i><span>0</span>
                    </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach @endif
    </div>
</div>
<script>
    var token = '{{ Session::token() }}';
  var urllike = '{{ route('like') }}';
</script>
@endsection