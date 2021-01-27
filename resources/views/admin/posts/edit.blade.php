@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <h1>Crea nuovo post</h1>
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
                {{-- </div>
                    <select name="">
                        <option>Seleziona taglia</option>
                        <option value="xs">XS</option>
                        <option value="s">S</option>
                        <option value="m">M</option>
                        <option value="l">L</option>
                        <option value="xl">XL</option>
                        <option value="xxl">XXL</option>
                    </select>
                    <input type="text" name="size" class="form-control" placeholder="Taglia">
                </div> --}}
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Salva post</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
