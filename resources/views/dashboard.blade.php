@extends('layouts.main')
@section('tittle', 'Index')
@section('content')

<div id="livros-container" class="col-md-12 text-center">
    <h2 class="mt-4">Livros Atuais</h2>
    <div id="card-container" class="row">
        @foreach ($books as $book)
        <div class="card col-md-3 mt-4 mx-4">
            <img src="{{ asset($book->image) }}" class="card-img-top" alt="Imagem do Livro">
            <div class="card-body">
                <p class="card-title"><strong>Título: </strong>{{ $book->title }}</p>
                <p class="card-text"><strong>Valor: </strong>{{ $book->value }}</p>
                <a href="/produto{{$book->id}}" class="btn bg-body-tertiary">Saber mais</a>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection

