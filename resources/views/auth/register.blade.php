@extends('master')

@section('title')
Create Account
@endsection

@section('content')
<br>
<br>
<br>
<div class="container">
    <h1 class="title">Create an account</h1>
    <h3 class="subtitle">For more awesomeness</h3>
    <div class="box">
        <form action="/register" method="POST">
            <label for="" class="label">First Name &nbsp;</label>
            <p class="control is-expanded">
                <input type="text" name="first_name" id="first_name" class="input{{$errors->has('first_name')? ' is-danger':''}}" placeholder="First Name" value="{{Request::old('first_name')}}">
                @if($errors->has('first_name'))
                    <span class="help is-danger">{{$errors->first('first_name')}}</span>
                @endif
            </p>
            <label for="" class="label">Last Name &nbsp;</label>
            <p class="control is-expanded">
                <input type="text" name="last_name" id="last_name" class="input{{$errors->has('last_name')? ' is-danger' : ''}}" placeholder="Last Name" value="{{Request::old('last_name')}}">
                @if($errors->has('last_name'))
                <span class="help is-danger">{{$errors->first('last_name')}}</span>
                @endif
            </p>
            <label for="" class="label">Username</label>
            <p class="control">
                <input type="text" name="username" id="" class="input{{$errors->has('username')? ' is-danger' : ''}}" placeholder="Username" value="{{Request::old('username')}}">
                @if($errors->has('username'))
                <span class="help is-danger">{{$errors->first('username')}}</span>
                @endif
            </p>
            <label for="" class="label">Gender</label>
            <p class="control">
                <label for="" class="radio">
                    <input type="radio" name="gender" id="" value="male" checked> Male
                </label>
                <label for="" class="radio">
                    <input type="radio" name="gender" id="" value="female"> Female
                </label>
            </p>
            <label for="" class="label">Email</label>
            <p class="control">
                <input type="email" name="email" id="" class="input{{$errors->has('email')? ' is-danger' : ''}}" placeholder="Email" value="{{Request::old('email')}}">
                @if($errors->has('email'))
                <span class="help is-danger">{{$errors->first('email')}}</span>
                @endif
            </p>
            <label for="" class="label">Password</label>
            <p class="control">
                <input type="password" name="password" id="" class="input{{$errors->has('password')? ' is-danger': ''}}" placeholder="Password">
                @if($errors->has('password'))
                <span class="help is-danger">{{$errors->first('password')}}</span>
                @endif
            </p>
            <label for="" class="label">Confirm Password</label>
            <p class="control">
                <input type="password" name="password_confirmation" id="" class="input" placeholder="Confirm Password">
            </p>
            <p class="control">
                <label for="" class="checkbox">
                    <input type="checkbox" name="terms" id="" > I agree to the terms and conditions
                </label>
                @if($errors->has('terms'))
                    <span class="help is-danger">You must agree to the terms</span>
                @endif
            </p>
            <button class="button is-danger">Register</button>
            {{csrf_field()}}
        </form>
    </div>
</div>
<br>
<br>
<br>
@endsection