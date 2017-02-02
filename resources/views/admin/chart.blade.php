@extends('master')

@section('title')
{{$title}}
@endsection

@section('styles')
{!! Charts::assets() !!}
@endsection

@section('content')
<div class="column">
    <div class="container box">
        {!! $chart->render() !!}
    </div>
</div>
@endsection