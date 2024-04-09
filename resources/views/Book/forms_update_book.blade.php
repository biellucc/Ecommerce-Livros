@extends('layouts.main')
@section('title', 'Atualizar Livro')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 mt-4">
                <div class="card">
                    <div class="card-header text-center">Livro: {{ $book->title }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('livro.update', $book->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">{{ __('Título') }}</label>
                                <input type="text" class="form-control" id="title" name="title" max="100"
                                    placeholder="It a Coisa">
                            </div>
                            <div class="mb-3">
                                <label for="summary" class="form-label">{{ __('Resumo') }}</label>
                                <input type="text" class="form-control" id="summary" name="summary" max="200">
                            </div>
                            <div class="mb-3">
                                <label for="pages" class="form-label">{{ __('Quantidade de Páginas') }}</label>
                                <input type="number" class="form-control" id="pages" name="pages" min="1"
                                    placeholder="1104">
                            </div>
                            <div class="mb-3">
                                <label for="author" class="form-label">{{ __('Autor do Livro') }}</label>
                                <input type="text" class="form-control" id="author" name="author" max="80"
                                    placeholder="Stephen King">
                            </div>

                            <div class="mb-3">
                                <label for="language" class="form-label">{{ __('Idioma do Livro') }}</label>
                                <select id="language" name="language">
                                    <option value="portugues">Português</option>
                                    <option value="ingles">Inglês</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="parental_rating" class="form-label">{{ __('Idade Recomendada') }}</label>
                                <input type="number" class="form-control" id="parental_rating" name="parental_rating"
                                    placeholder="18">
                            </div>

                            <div class="mb-3">
                                <label for="publication_date" class="form-label">{{ __('Data de Publicação') }}</label>
                                <input type="date" class="form-control" id="publication_date" name="publication_date">
                            </div>

                            <div class="mb-3">
                                <label for="type" class="form-label">{{ __('Genero') }}</label>
                                <select id="type" name="type">
                                    <option value="acao">Ação</option>
                                    <option value="aventura">Aventura</option>
                                    <option value="terror">Terror</option>
                                    <option value="fantasia">Fantasia</option>
                                    <option value="educacional">Educacional</option>
                                    <option value="drama">Drama</option>
                                    <option value="romance">Romance</option>
                                    <option value="auto_ajuda">Auto Ajuda</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="edition" class="form-label">{{ __('Edição') }}</label>
                                <input type="number" class="form-control" id="edition" name="edition" placeholder="1">
                            </div>

                            <div class="mb-3">
                                <label for="dimension" class="form-label">{{ __('Dimensão') }}</label>
                                <input type="text" class="form-control" id="dimension" name="dimension"
                                    placeholder="125 x 110">
                            </div>

                            <div class="mb-3">
                                <label for="isbn13" class="form-label">{{ __('ISBN13') }}</label>
                                <input type="text" class="form-control" id="isbn13" name="isbn13"
                                    placeholder="978-66-876549-8-5">
                            </div>

                            <div class="mb-3">
                                <label for="publishing_company" class="form-label">{{ __('Nome da Editora') }}</label>
                                <input type="text" class="form-control" id="publishing_company"
                                    name="publishing_company" placeholder="Suma">
                            </div>
                            <div class="mb-3">
                                <label for="amount" class="form-label">{{ __('Quantidade') }}</label>
                                <input type="number" class="form-control" id="amount" name="amount"
                                    placeholder="12" min="1">
                            </div>
                            <div class="mb-3">
                                <label for="value" class="form-label">{{ __('Valor') }}</label>
                                <input type="number" step="any" class="form-control" id="value" name="value"
                                    placeholder="70.95" min="1" step="0.01">
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">{{ __('Imagem') }}</label>
                                <input type="file" class="form-control" id="image" name="image"
                                    accept="image/jpeg,image/png">
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">{{ __('Atualizar') }}</button>
                            </div>
                        </form>
                        <div class="d-grid mt-4">
                            <a href="{{ route('vendor.livro_informacao', $book->id) }}"
                                class="btn btn-primary">Voltar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
