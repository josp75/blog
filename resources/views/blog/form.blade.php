<form action="" method="post" class="vstack gap-2" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="image">
            Selectionner une image
            <input type="file" class="form-control @error("image") is-invalid @enderror" name="image"
                  >
        </label>
        @error('image')
        {{ $message }}
        @enderror
    </div>
    <div class="form-group">
        <label for="title">
            Mon titre
            <input type="text" class="form-control @error("title") is-invalid @enderror" name="title"
                   value="{{ old('title', $post->title) }}">
        </label>
        @error('title')
        {{ $message }}
        @enderror
    </div>
    <div class="form-group">
        <label for="slug">
            Slug
            <input type="text" class="form-control @error("slug") is-invalid @enderror" name="slug"
                   value="{{ old('slug',  $post->slug) }}" id="slug">
        </label>
        @error('slug')
        {{ $message }}
        @enderror
    </div>
    <div class="form-group">
        <label for="content">
            Contenu
            <textarea class="form-control @error("content") is-invalid bg @enderror" name="content" id="" cols="30"
                      rows="10">{{ old('content',  $post->content) }} </textarea>
        </label>
        @error('content')
        {{ $message }}
        @enderror
    </div>
    <div class="form-group">
        <label for="category">
            Catégorie
            <select name="category_id" id="category" class="form-control">
                <option value="">Sélectionner une catégorie</option>
                @foreach($categories as $category)
                    <option @selected(old('category_id', $post->category_id) === $category->id) value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </label>
        @error('category_id')
        {{ $message }}
        @enderror
    </div>
    @php
    $tagsIds = $post->tags()->pluck('id');
    @endphp
    <div class="form-group">
        <label for="tag">
            Tags
            <select name="tags[]" id="tag" class="form-control" multiple>
                <option value="">Sélectionner un ou plusieurs tags</option>
                @foreach($tags as $tag)
                    <option @selected($tagsIds->contains($tag->id)) value="{{$tag->id}}">{{$tag->name}}</option>
                @endforeach
            </select>
        </label>
        @error('tags')
        {{ $message }}
        @enderror
    </div>
    <button class="btn btn-primary col-1">
        @if($post->id)
            Modifier
        @else
            Créer
        @endif
    </button>
</form>
