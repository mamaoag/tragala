@extends('master')

@section('title')
Forget Password
@endsection

@section('content')
<br>
<br>
<br>
<div class="container">
    <div class="box">
        <h2 class="title">Forget Password</h2>
        <h4 class="subtitle">Looks like you forgot your password, we are happy to assist you.</h4>
        <form action="/forget" method="POST">
            <label for="email" class="label">Enter Email</label>
            <p class="control">
                <input type="text" name="email" id="email" class="input{{$errors->has('email')? ' is-danger' : ''}}">
                @if($errors->has('email'))
                    <span class="help is-danger">{{$errors->first('email')}}</span>
                @endif
            </p>
            <button type="submit" class="button is-danger">Send Email</button>
            {{csrf_field()}}
        </form>
    </div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
@endsection