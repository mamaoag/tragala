@extends('master')

@section('title')
Your notifications
@endsection

@section('content')
<div class="container">
@if($notifs->count() < 1)
<br>
<br>
<br>
    <h1 class="subtitle has-text-centered">No notifications</h1>
@endif
@foreach($notifs as $notif)
    <article class="media box">
  <figure class="media-left">
    
  </figure>
  <div class="media-content">
    <div class="content">
      <p>
        <small>{{$notif->created_at->diffForHumans()}}</small>
        <br>
        {{$notif->data['message']}}
      </p>
    </div>
</article>
@endforeach
</div>
@endsection