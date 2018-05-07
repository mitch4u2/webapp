@extends ("layouts.app") 
@section ('content')

<div class="bootstrap snippet">
    <div class="row">
        <div class=" col-md-6 col-md-12">
            <div class="well well-sm well-social-post">
                {!! Form::open(['action'=> 'PostsController@store','method'=>'POST','enctype'=>'multipart/form-data']) !!}
                <ul class="list-inline" id='list_PostActions'>
                    <li class='active'><a href='#'>Update status</a></li>
                    <li><a href='#'>Add photos/Video</a></li>
                    <li><a href='#'>Create photo album</a></li>
                </ul>
                <ul class="list-inline">
                    <li style="top: -80px;"><a href="#">
                    <img src="/storage/profile_image/{{ Auth::user()->profile_image }}" class="img-circle-post" />
                        </a>
                </li>
                    <li style="width:80%">
                        {{Form::textarea('body','',['id'=>'body',"class"=>"form-control","size"=>"0x0",'name'=>'body','placeholder'=>'whats on your mind'])}}
                    </li>
                </ul>

                <ul class='list-inline post-actions'>
                    <li class="image-upload">
                        <label for="file-input">
                                <span style="cursor:pointer;" class="glyphicon glyphicon-camera"></span>
                        </label> {{Form::file('cover_image',['id'=>'file-input'])}}
                    </li>
                    <li><a href="#" class='glyphicon glyphicon-user'></a></li>
                    <li><a href="#" class='glyphicon glyphicon-map-marker'></a></li>
                    <li class='pull-right'> {{Form::submit('Post', ['class'=> 'btn btn-primary btn-xs'])}}</li>
                </ul>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>


@if(count($posts)>0)
<ul class="media-list">
    @foreach($posts as $post)
    <li class="media well">
        <a href="/users/{{$post->user['id']}}" class="pull-left">
              <img src="/storage/profile_image/{{$post->user['profile_image']}}" class="img-circle" />
        </a>
        <div class="media-body" data-postid="{{$post->id}}">
                <i class="{{ Auth::user()->favorites()->where('post_id',$post->id)->first() ? 'fas bookmark-icon-full' :'far bookmark-icon' }} fa-bookmark  pull-right"></i>
          
            <strong class="text-success">{{$post->user['name']}}</strong>
            <br />
            <small class="text-default">{{$post->user->team['name']}}</small>
            <br>
            <span class="text-muted">
                    <small class="text-muted">{{$post->created_at}}</small>
            </span>
        </div>
        <br />
        <hr />
        <p>{!! $post->body !!}</p>
        <img style="width:100%" class="post-media" src="/storage/cover_image/{{$post->cover_image}}" alt="" />

        <hr />
        <div class="reactions" data-postid="{{$post->id}}">
            <ul class="list-inline">
                <li>
                    <button type="button" class=" btn {{ Auth::user()->likeposts()->where('post_id',$post->id)->first() ? Auth::user()->likeposts()->where('post_id',$post->id)->first()->like_dislike == 1 ? 'btn-primary' : 'btn-default' : 'btn-default' }} btn-sm btn-like like">
                            <i class="fa fa-thumbs-up icon"></i> <span>
                                <?php $var = 0 ;?>
                                @foreach($post->likeposts as $like)
                                 @if($like->like_dislike)
                                 <?php /**/ $var ++; /**/ ?>
                                @endif
                            @endforeach
                            <?php echo $var; ?>
                        </span>
                    </button>
                </li>
                <li class="list-inline-item">
                    @foreach($post->likeposts as $like) @if($like->like_dislike)
                    <a href="/user/{{$like->user['id']}}" data-toggle="tooltip" data-placement="bottom" title="{{$like->user['name']}}"><img src="/storage/profile_image/{{$like->user['profile_image']}}" alt="{{$like->user['name']}}" class="img-circle-like" /></a>                    @endif @endforeach
                </li>
            </ul>

            <ul class="list-inline pull-right">
                <li class="list-inline-item">
                    @foreach($post->likeposts as $like) @if(!$like->like_dislike)
                    <a href="/user/{{$like->user['id']}}" data-toggle="tooltip" data-placement="bottom" title="{{$like->user['name']}}"><img src="/storage/profile_image/{{$like->user['profile_image']}}" alt="{{$like->user['name']}}" class="img-circle-like" /></a>                    @endif @endforeach
                </li>
                <li class="btn-dis">
                    <button type="button" class="btn {{ Auth::user()->likeposts()->where('post_id',$post->id)->first() ? Auth::user()->likeposts()->where('post_id',$post->id)->first()->like_dislike == 0 ? 'btn-primary' : 'btn-default' : 'btn-default' }} btn-sm btn-dislike like">
                        <i class="fa fa-thumbs-down icon"></i> <span>
                        <?php $var = 0;?>
                        @foreach($post->likeposts as $like)
                            @if(!$like->like_dislike)
                                <?php /**/ $var ++; /**/ ?>
                           @endif
                        @endforeach
                        <?php echo $var; ?></span>
                        </button>
                </li>
            </ul>
        </div>
        <br />
        <br />
        <hr /> {!! Form::open(['action'=> 'CommentsController@store','method'=>'POST']) !!}
        <div class="input-group">
            <span class="input-group-btn">
                    {{Form::submit('Comment', ['class'=> 'btn btn-default'])}}
                </span> {{Form::text('body','',['id'=>'comment', 'class'=>'form-control','placeholder'=>'Comment Somthing...'])}}
            <input name="post_id" type="hidden" value="{{$post->id}}">
        </div>
        {!! Form::close() !!}
        <hr>
        <br> @if(count($post->comments)>0) @foreach($post->comments as $comment)
        <hr>
        <ul class="list-inline pull-left">
            <li class="list-inline-item">
                <a href="/user/{{$comment->user['id']}}" data-toggle="tooltip" data-placement="bottom" title="{{$comment->user['name']}}"><img src="/storage/profile_image/{{$comment->user['profile_image']}}" alt="{{$comment->user['name']}}" class="img-circle-like" /></a>
            </li>
            <li class="list-inline-item">
                <strong><a href="/user/{{$comment->user['id']}}">{{$comment->user['name']}}</a></strong>
            </li>
            <li class="list-inline-item">
                <p>{{$comment->body}}</p>
            </li>
            {{-- <br> --}} {{--
            <li class="list-inline-item pull-right">
                <div class="stats" data-commentid="{{$comment->id}}">
                    <a class="btn {{ Auth::user()->likes()->where('comment_id',$comment->id)->first() ? Auth::user()->likes()->where('comment_id',$comment->id)->first()->like_dislike == 1 ? 'btn-primary' : 'btn-default' : 'btn-default' }} stat-item like">
                    <i class="fa fa-thumbs-up icon"></i><span>{{ $likes->where('comment_id', $comment->id)->where('like_dislike',true)->count()  }}</span>
                </a>
                    <a class="btn {{ Auth::user()->likes()->where('comment_id',$comment->id)->first() ? Auth::user()->likes()->where('comment_id',$comment->id)->first()->like_dislike == 0 ? 'btn-primary' : 'btn-default' : 'btn-default' }} stat-item like">
                <i class="fa fa-thumbs-down icon"></i><span>{{ $likes->where('comment_id', $comment->id)->where('like_dislike',false)->count()  }}</span>                    
            </a>
                </div>
            </li> --}}
        </ul>
        @endforeach @endif




    </li>

    {{-- @if(count($comments)>0) @foreach($comments as $comment)
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
                @if(!Auth::guest())
                <div class="stats" data-commentid="{{$comment->id}}">
                    <a class="btn {{ Auth::user()->likes()->where('comment_id',$comment->id)->first() ? Auth::user()->likes()->where('comment_id',$comment->id)->first()->like_dislike == 1 ? 'btn-primary' : 'btn-default' : 'btn-default' }} stat-item like">
                            <i class="fa fa-thumbs-up icon"></i><span>{{ $likes->where('comment_id', $comment->id)->where('like_dislike',true)->count()  }}</span>
                    </a>
                    <a class="btn {{ Auth::user()->likes()->where('comment_id',$comment->id)->first() ? Auth::user()->likes()->where('comment_id',$comment->id)->first()->like_dislike == 0 ? 'btn-primary' : 'btn-default' : 'btn-default' }} stat-item like">
                        <i class="fa fa-thumbs-down icon"></i><span>{{ $likes->where('comment_id', $comment->id)->where('like_dislike',false)->count()  }}</span>
                    </a>
                </div>

                @endif
            </div>
        </div>
    </div>
    @endforeach @endif --}} {{--
    <div class="well">
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <img style="width:100%" src="/storage/cover_image/{{$post->cover_image}}" alt="">
            </div>
            @if(!Auth::guest())
            <button type="button" data-postid="{{$post->id}}" class="btn {{ Auth::user()->favorites()->where('post_id',$post->id)->first() ? 'btn-danger' :'btn-default' }} favorite">
    <span style="pointer-events:none;"class="glyphicon glyphicon-heart"></span><b style="pointer-events:none;"> {{ Auth::user()->favorites()->where('post_id',$post->id)->first() ? 'Remove From Favorite' :'Add to Favorite' }}</b>
</button> @endif
            <div class="col-md-8 col-sm-8">
                <h3><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></h3>
                <small>Written on {{ $post->created_at }} by {{$post->user['name']}}</small>
            </div>
        </div>
    </div> --}}
@endforeach
</ul>
@else
<p>NO POSTS FOUND</p>
@endif
<script>
    var token = '{{ Session::token() }}';
    var urlfavorite = '{{ route('favorite') }}';
    var urlLikePost = '{{ route('likePost') }}';

</script>
}
@endsection