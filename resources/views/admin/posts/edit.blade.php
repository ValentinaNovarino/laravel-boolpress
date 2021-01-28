@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <h1>Modifica post</h1>
            <form method="POST" action="{{ route('admin.posts.update', ['post' => $post->id]) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Titolo</label>
                    <input type="text" value="{{ $post->title }}" name="title" class="form-control" placeholder="Inserisci titolo">
                </div>
                <div class="form-group">
                    <label>Testo post</label>
                    <input type="text" value="{{ $post->content }}" name="content" class="form-control" placeholder="Scrivi qualcosa qui...">
                </div>
                <div>
                    <div class="mb-2">
                        <span>Categoria post</span>
                    </div>
                    <select class="form-control" name="category_id">
                        <option>Seleziona categoria</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary">Salva post</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
