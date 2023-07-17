@extends('layouts.main')

@section('title', 'Vender')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 mt-4">
            <div class="card">
                <div class="card-header text-center">{{ __('Livro') }}</div>

                <div class="card-body">
                    <form method="POST" action="/cadastroBook" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">{{ __('Título') }}</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>

                        <div class="mb-3">
                            <label for="summary" class="form-label">{{ __('Resumo') }}</label>
                            <input type="text" class="form-control" id="summary" name="summary" required>
                        </div>

                        <div class="mb-3">
                            <label for="pages" class="form-label">{{ __('Quantidade de Páginas') }}</label>
                            <input type="number" class="form-control" id="pages" name="pages" required>
                        </div>

                        <div class="mb-3">
                            <label for="author" class="form-label">{{ __('Autor do Livro') }}</label>
                            <input type="text" class="form-control" id="author" name="author" required>
                        </div>

                        <div class="mb-3">
                            <label for="amount" class="form-label">{{ __('Quantidade') }}</label>
                            <input type="number" class="form-control" id="amount" name="amount" required>
                        </div>

                        <div class="mb-3">
                            <label for="value" class="form-label">{{ __('Valor') }}</label>
                            <input type="number" step="any" class="form-control" id="value" name="value" required>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">{{ __('Imagem') }}</label>
                            <input type="file" class="form-control" id="image" name="image" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">{{ __('Postar') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
