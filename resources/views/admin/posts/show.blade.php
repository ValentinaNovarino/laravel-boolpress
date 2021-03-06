@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h1>Visualizzazione post {{ $post->id }}</h1>
                <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity"><line x1="20" y1="12" x2="4" y2="12"></line><polyline points="10 18 4 12 10 6"></polyline></svg> Tutti i posts
                </a>
            </div>
            <div>
                <span class="text-uppercase d-block">Titolo</span>
                <span class="d-block">{{ $post->title }}</span>
                <span class="text-uppercase d-block">Slug</span>
                <span class="d-block">{{ $post->slug }}</span>
                <span class="text-uppercase d-block">Immagine di copertina</span>
                <div>
                    @if($post->cover)
                        <img src="{{ asset('storage/' . $post->cover) }}" alt="{{ $post->title }}">
                    @else
                        <p>copertina non presente</p>
                    @endif
                </div>
                <span class="text-uppercase d-block">Contenuto</span>
                <span class="d-block">{{ $post->content }}</span>
                <span class="text-uppercase d-block">Categoria</span>
                <span class="d-block">{{ $post->category ? $post->category->name : '-' }}</span>
                <span class="text-uppercase d-block">Tag</span>
                <span class="d-block">
                    @forelse ($post->tags as $tag)
                        {{ $tag->name }}{{ !$loop->last ? ',' : '' }}
                    @empty
                        -
                    @endforelse
                </span>
            </div>
            <div class="mt-4">
                <a href="{{ route('admin.posts.edit', ['post' => $post->id]) }}"
                class="btn btn-warning mr-3">Modifica</a>
                <form class="d-inline" action="{{ route('admin.posts.destroy', ['post' => $post->id]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        Elimina
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
