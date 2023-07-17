@extends('layouts.main')
@section('title', 'Atualizar Livro')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 mt-4">
            <div class="card">
                <div class="card-header text-center">Livro: {{ $book->title }}</div>
                <div class="card-body">
                    <form method="POST" action="/atualizarLivro{{ $book->id }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">{{ __('Título') }}</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="mb-3">
                            <label for="summary" class="form-label">{{ __('Resumo') }}</label>
                            <input type="text" class="form-control" id="summary" name="summary">
                        </div>
                        <div class="mb-3">
                            <label for="pages" class="form-label">{{ __('Quantidade de Páginas') }}</label>
                            <input type="number" class="form-control" id="pages" name="pages">
                        </div>
                        <div class="mb-3">
                            <label for="author" class="form-label">{{ __('Autor do Livro') }}</label>
                            <input type="text" class="form-control" id="author" name="author">
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="form-label">{{ __('Quantidade') }}</label>
                            <input type="number" class="form-control" id="amount" name="amount">
                        </div>
                        <div class="mb-3">
                            <label for="value" class="form-label">{{ __('Valor') }}</label>
                            <input type="number" step="any" class="form-control" id="value" name="value">
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">{{ __('Imagem') }}</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">{{ __('Atualizar') }}</button>
                        </div>
                    </form>
                    <div class="d-grid mt-4">
                        <a href="/livros-informacoes{{ $book->id }}" class="btn btn-primary">Voltar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
