@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <h1>Crea nuovo post</h1>
            <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Titolo</label>
                    <input type="text" name="title" class="form-control" placeholder="Inserisci titolo" value="{{ old('title') }}">
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Immagine di copertina</label>
                    <input type="file" class="form-control-file @error('image') is-invalid @enderror" name="image">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Testo post</label>
                    <textarea name="content" class="form-control" rows="10" placeholder="Inizia a scrivere qualcosa..." required>{{ old('content') }}</textarea>
                    @error('content')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <div class="mb-2">
                        <span>Categoria post</span>
                    </div>
                    <select class="form-control" name="category_id">
                        <option>Seleziona categoria</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected=selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <p class="mt-3">Inserisci i tag:</p>
                    @foreach ($tags as $tag)
                        <div class="form-check">
                            <input name="tags[]" class="form-check-input" type="checkbox" value="{{ $tag->id }} {{ in_array($tag->id, old('tags', [])) ? 'checked=checked' : '' }}">
                            <label class="form-check-label">
                                {{ $tag->name }}
                            </label>
                        </div>
                    @endforeach
                    @error('tags')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary">Salva post</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
