@extends('master')

@section('title')
{{$user->first_name}} {{$user->last_name}}'s profile
@endsection

@section('content')
@if($user->activated)
<div class="container">
    <div class="columns is-gapless">
        <div class="column">
        <section class="hero is-medium" style="background:url({{$user->banner}}); background-size:cover">
            <div class="hero-body">
            <h1 class="title" style="color:#fff">&nbsp; {{$user->first_name}} {{$user->last_name}}</h1>
            </div>
        </section>
        <br>
        @if($user->posts()->count() < 1)
        <h1 class="subtitle">User hasn't made any posts yet</h1>
        @endif
        <profile :id="{{$user->id}}"></profile>
        <br>
        <br>
        </div>
        <div class="column is-2" height="">
            <div class="box">
                <figure class="image is-128x128">
                    <img src="{{$user->avatar}}" alt="" style="border-radius: 50%; border: 3px solid #fff; margin-left: 5%">
                </figure>
                <br>
                <h1 class="subtitle has-text-centered">{{$user->first_name}} {{$user->last_name}}</h1>
                @if($user->usergroup > 1)
                <h2 class="menu-label has-text-centered">Verified Account</h2>
                @endif
                <h2 class="menu-label has-text-centered">{{$user->username}}</h2>
                @if(Auth::user()->username == Request::segment(2))
                <a href="/u/{{Auth::user()->username}}/edit" class="button is-danger" style="margin-left:20%">Edit Profile</a>
                @endif
                <friend :id="{{$user->id}}" :count="{{$user->followers()->count()}}"></friend>
            </div>
        </div>
    </div>
</div>
@else
    <div class="container">
        <br>
        <br>
        <br>
        <br>
        <br>
        <h1 class="title has-text-centered">Sorry, this user's account has been deactivated</h1>
    </div>
@endif
@endsection