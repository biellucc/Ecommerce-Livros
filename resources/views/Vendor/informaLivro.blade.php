@extends('layouts.main')
@section('tittle', 'Informações do Livro')
@section('content')

<div class="container">
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <img src="{{ asset($book->image) }}" class="card-img-top" alt="Imagem do Livro">
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $book->title }}</h5>
                    <p class="card-text"><strong>Autor:</strong> {{ $book->author }}</p>
                    <p class="card-text"><strong>Quantidade de Páginas:</strong> {{ $book->pages }}</p>
                    <p class="card-text"><strong>Estoque:</strong> {{ $book->amount }}</p>
                    <p class="card-text"><strong>Valor:</strong> R$ {{ number_format($book->value, 2, ',', '.') }}</p>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title">Resumo do Livro</h5>
                    <p class="card-text">{{ $book->summary }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1">
            <a href="/atualizarLivro{{ $book->id }}" class="btn btn-success">Atualizar</a>
        </div>
        <div class="col-md-1">
            <form action="{{ route('livro.rm', $book->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Deletar</button>
            </form>
        </div>
        <div class="col-md-1">
            <a href="/livrosCadastrados" class="btn btn-primary">Voltar</a>
        </div>
    </div>
</div>

@endsection
