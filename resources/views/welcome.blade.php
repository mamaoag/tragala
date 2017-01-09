@extends('master')

@section('title')
    Tragala
@endsection

@section('content')
<section class="hero is-primary is-bold is-fullheight" style="background:url({{asset('images/bg.jpg')}});background-size:cover">
    <div class="hero-body">
        <div class="container">
            <h1 class="title">Tragala</h1>
            <h2 class="subtitle">Discover.Share.Experience</h2>
            <p class="control has-addons">
                <input type="text" class="input" placeholder="Search location">
                <a href="" class="button is-danger">Search</a>
            </p>
        </div>
    </div>
</section>
@endsection