@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Contatti</h1>
                <form action="{{ route('contact.sent') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" name="name" class="form-control" placeholder="Inserisci il tuo nome" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control" placeholder="Inserisci la tua email" required>
                    </div>
                    <div class="form-group">
                        <label>Messaggio</label>
                        <textarea name="message" class="form-control" placeholder="Inserisci il messaggio" required></textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Invia">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
