@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-end">
                    <a class="btn btn-primary " href="{{ route('posts.index') }}">Tutti i post</a>
                </div>
                <h1>{{ $post->title }}</h1>
                <div>
                    <p>{{ $post->content }}</p>
                    <p>Categoria:
                        @if ($post->category)
                            <a href="{{ route('categories.show', ['slug' => $post->category->slug]) }}">
                                {{ $post->category->name }}
                            </a>
                        @else
                            -
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
