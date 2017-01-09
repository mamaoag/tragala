@extends('master')

@section('title')
Post
@endsection

@section('content')
<section class="hero is-medium" style="background:url({{$post->filename}}); background-size:cover">
    <div class="hero-body">
        <h1 class="title" style="color:#fff">&nbsp;"{{$post->description}}"</h1>
        <h2 class="subtitle" style="color:#fff">&nbsp; @ {{$post->user->username}}</h2>
    </div>
    
</section>
<br>
<h1 class="subtitle">&nbsp;Comments</h1>
<comment :id="{{$post->id}}" :uid="{{$post->user_id}}"></comment>
@endsection