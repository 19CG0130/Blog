@extends('front.layouts.main')
@section('container')
<div class="container px-4 px-lg-5">
<div class="text-center">
    <img src="{{ asset('img/posts/'.$datos->img) }}" alt="" class="img-responsive">
</div>
    <h1>{{ $datos->title }}</h1>
    <p>
        {{ $datos->content }}
    </p>
</div>
@endsection