@extends('master')

@section('title')
Edit Profile
@endsection

@section('content')
    <edit :id="{{Auth::user()->id}}"></edit>
@endsection