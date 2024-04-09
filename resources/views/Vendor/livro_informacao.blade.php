@extends('layouts.main')
@section('title', 'Informações do Livro')
@section('content')

<div class="container">
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <img src="/assets/imagem/{{ $book->image }}" alt="Imagem do Livro" style="padding-top: 20px;">
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $book->title }}</h5>
                    <p class="card-text"><strong>Autor:</strong> {{ $book->author }}</p>
                    <p class="card-text"><strong>Quantidade de Páginas:</strong> {{ $book->pages }}</p>
                    <p class="card-text"><strong>Edição:</strong> {{ $book->edition }}</p>
                    <p class="card-text"><strong>Idioma:</strong> {{ $book->language }}</p>
                    <p class="card-text"><strong>Genero:</strong> {{ $book->type }}</p>
                    <p class="card-text"><strong>Recomendado para:</strong> {{ $book->parental_rating}}+ anos </p>
                    <p class="card-text"><strong>Editora:</strong> {{ $book->publishing_company }}</p>
                    <p class="card-text"><strong>ISBN13:</strong> {{ $book->isbn13 }}</p>
                    <p class="card-text"><strong>Dimensão:</strong> {{ $book->dimension }}</p>
                    <p class="card-text"><strong>Data de Publicação:</strong> {{ $book->publication_date }}</p>
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
            <a href="{{ route('livro.forms_update', $book->id) }}" class="btn btn-success">Atualizar</a>
        </div>
        <div class="col-md-1">
            <form action="{{ route('livro.rm', $book->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Deletar</button>
            </form>
        </div>
        <div class="col-md-1">
            <a href="{{ route('vendor.listaMeusLivros') }}" class="btn btn-primary">Voltar</a>
        </div>
    </div>
</div>

@endsection
