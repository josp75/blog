@extends('base')
@section('title', 'Mon blog')

@section('content')
    <h1> Mon blog </h1>
    @isset($posts)
       @foreach($posts as $post)
           <article>
               <h2>{{ $post->title }}</h2>
               <p>{{$post->title}}</p>
               <a href="{{ route('blog.show', ['slug' => $post->slug, 'id' => $post->id]) }}" class="btn btn-primary">Voir plus</a>
           </article>
       @endforeach
        {{ $posts->links() }}
    @endisset
@endsection
