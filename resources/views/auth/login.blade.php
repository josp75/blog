@extends('base')
@section('title', 'Authentification')

@section('content')

    <h1>Se connecter</h1>

    <div class="card ">
        <div class="card-body">
            <form action="" method="post" class="vstack gap-3">
                @csrf
                <div class="form-group">
                    <label for="email">
                        Email</label>
                    <input type="email" class="form-control @error("email") is-invalid @enderror" name="email"
                           value="{{ old('slug') }}" id="email">

                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">
                        Mot de passe</label>
                    <input type="password" class="form-control @error("password") is-invalid @enderror" name="password"
                           value="" id="password">

                    @error('password')
                    {{ $message }}
                    @enderror
                </div>
                <button class="btn btn-primary">
                    Se connecter
                </button>
            </form>
        </div>
    </div>

@endsection
