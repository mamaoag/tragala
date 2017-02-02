@extends('master')

@section('title')
Login
@endsection

@section('content')
<br>
<br>
<br>
<div class="container">
    <h1 class="title">Login account</h1>
    <div class="box">
        <form action="/login" method="POST">
            <label for="" class="label">Username / Email</label>
            <p class="control">
                <input type="text" name="username" id="" class="input{{$errors->has('username')? ' is-danger' : ''}}">
                @if($errors->has('username'))
                <span class="help is-danger">{{$errors->first('username')}}</span>
                @endif
            </p>
            <label for="" class="label">Password</label>
            <p class="control">
                <input type="password" name="password" id="" class="input{{$errors->has('password')? ' is-danger': ''}}">
                @if($errors->has('password'))
                <span class="help is-danger">{{$errors->first('password')}}</span>
                @endif
            </p>
            <button class="button is-danger">Login</button>
            <a href="{{url('/auth/facebook')}}" class="button facebook"><i class="fa fa-facebook-square"></i> &nbsp;Login via Facebook</a>
            <a href="/forget" class="button is-link">Forget password</a>
            {{csrf_field()}}
        </form>
    </div>
</div>
<br>
<br>
<br>
@endsection