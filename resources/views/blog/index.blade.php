@extends('base')
@section('title', 'Mon blog')

@section('content')
    <h1> Mon blog </h1>
    @isset($posts)
        @foreach($posts as $post)
            <article>
                <h2>{{ $post->title }}</h2>
                @if($post->category )
                    <p class="small">  {{  $post->category->name   }}</p>
                @endif
                @if(!$post->tags->isEmpty())
                    <p class="small">
                        Tags :
                        @foreach( $post->tags as $tag)
                        <span class="badge bg-secondary">{{ $tag->name }}</span>
                        @endforeach
                    </p>
                @endif
                @if($post->image)
                    <img src="{{ $post->getImageUrl() }}" alt="" style="width: 100%; height: 150px; object-fit: cover">
                @endif
                <p>{{$post->content}}</p>
                <a href="{{ route('blog.show', ['slug' => $post->slug, 'post' => $post]) }}" class="btn btn-primary">Voir
                    plus</a>
            </article>
        @endforeach
        {{ $posts->links() }}
    @endisset
@endsection
