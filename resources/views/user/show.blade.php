@extends ("layouts.app") 
@section ('content')
<h1>User Profile</h1>
<div class="container">

    <div class="row">

        <div class="col-md-10 col-md-offset-1">
            <div class="well well-sm">
                <img class="profile_image" src="/storage/profile_image/{{ $user->profile_image }}">

                <h2>{{ $user->name}}'s Profile</h2>
                <i class="glyphicon glyphicon-map-marker"></i>&nbsp;{{$user->address}}
                <p>
                    <i class="glyphicon glyphicon-envelope"></i>&nbsp; {{$user->email}}
                    <br />
                    <i class="glyphicon glyphicon-gift"></i>&nbsp; {{$user->birthday}}</p>
                <!-- Split button -->
                <a href="/user/edit" class="btn btn-default">Edit</a>
                <a href="/posts/edit" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
@endsection