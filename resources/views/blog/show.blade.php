@extends('base')
@section('title', $post->title)

@section('content')
    <article>
        <h1>{{ $post->title }}</h1>
        @if($post->image)
            <img src="{{ $post->getImageUrl() }}"  >
        @endif
        <p>{{$post->content}}</p>
    </article>

@endsection
