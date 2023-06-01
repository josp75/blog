@extends('base')
@section('title', 'Creation d\'un article')

@section('content')
    <form action="" method="post">
        @csrf
        <div>
            <label>
                <input type="text" name="title" value="{{ old('title', 'Article de démonstration') }}">
            </label>
            @error('title')
            {{ $message }}
            @enderror
        </div>
        <div>
            <label for="controller"><textarea name="content" id="" cols="30"
                                              rows="10">{{ old('content', 'Contenu de démonstration') }} </textarea></label>
            @error('content')
            {{ $message }}
            @enderror
        </div>
        <button>Enregistrer</button>
    </form>

@endsection
