@extends('layouts.main')
@section('title', 'Livros Cadastrados')
@section('content')

<div class="container d-flex justify-content-center" style="min-height: 100vh;">
<div id="livros-container" class="col-md-12 text-center">
    <h2 class="mt-4">Meus Livros Cadastrados</h2>
    <div id="card-container" class="row">
        @foreach ($books as $book)
        <div class="card col-md-3 mt-4 mx-4">
            <img src="/assets/imagem/{{ $book->image }}" alt="Imagem do Livro" style="padding-top: 20px;">
            <div class="card-body">
                <p class="card-title"><strong>Título: </strong>{{ $book->title }}</p>
                <p class="card-text"><strong>Valor: </strong>{{ $book->value }}</p>
                <p class="card-text"><strong>Estoque: </strong>{{ $book->amount }}</p>
                <a href="{{ route('vendor.livro_informacao', $book->id) }}" class="btn bg-body-tertiary">Saber mais</a>
            </div>
        </div>
        @endforeach
    </div>
</div>
</div>

@endsection
