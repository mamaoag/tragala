@extends('master')

@section('content')
<br>
<div class="box">
<h2 class="title has-text-centered">Hi {{Auth::user()->first_name}}!</h2>
<h5 class="subtitle has-text-centered">Here are the latest updates for you</h5>
</div>
<div class="tile is-ancestor">
  <div class="tile is-vertical is-8">
    <div class="tile">
      <div class="tile is-parent is-vertical">
        <article class="tile is-child notification is-primary">
          <p class="title has-text-centered">Unique Users of the Month</p>
          <br>
          <p class="has-text-centered title">0</p>
          <p class="has-text-centered subtitle">Users</p>
          <br>
        </article>
        <article class="tile is-child notification is-warning">
          <p class="title">New Reports</p>
          <p class="subtitle">No Reports</p>
        </article>
      </div>
      <div class="tile is-parent">
        <article class="tile is-child notification is-info">
          <p class="title">New Posts of the Day</p>
          <br>
          <br>
          <br>
          <br>
          <p class="has-text-centered title">With an image</p>
          <p class="has-text-centered subtitle">User</p>
        </article>
      </div>
    </div>
    <div class="tile is-parent">
      <article class="tile is-child notification is-danger">
        <p class="title">Wide tile</p>
        <p class="subtitle">Aligned with the right tile</p>
        <div class="content">
          <!-- Content -->
        </div>
      </article>
    </div>
  </div>
  <div class="tile is-parent">
    <article class="tile is-child notification is-success">
      <div class="content">
        <p class="title">Tall tile</p>
        <p class="subtitle">With even more content</p>
        <div class="content">
          <!-- Content -->
        </div>
      </div>
    </article>
  </div>
</div>
@endsection