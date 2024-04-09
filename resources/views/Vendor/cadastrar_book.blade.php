@extends('layouts.main')

@section('title', 'Cadastrar Livro')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 mt-4">
                <div class="card">
                    <div class="card-header text-center">{{ __('Livro') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('livro.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="title" class="form-label">{{ __('Título') }}</label>
                                <input type="text" class="form-control  @error('title') is-invalid @enderror"
                                    id="title" name="title" placeholder="It a Coisa">
                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="summary" class="form-label">{{ __('Resumo') }}</label>
                                <input type="text" class="form-control  @error('summary') is-invalid @enderror"
                                    id="summary" name="summary">
                                @error('summary')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="pages" class="form-label">{{ __('Quantidade de Páginas') }}</label>
                                <input type="number" class="form-control  @error('pages') is-invalid @enderror"
                                    id="pages" name="pages" placeholder="1104">
                                @error('pages')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="author" class="form-label">{{ __('Autor do Livro') }}</label>
                                <input type="text" class="form-control  @error('author') is-invalid @enderror"
                                    id="author" name="author" placeholder="Stephen King">
                                @error('author')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
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
                                <input type="number" class="form-control  @error('parental_rating') is-invalid @enderror"
                                    id="parental_rating" name="parental_rating" placeholder="18">
                                @error('parental_rating')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="publication_date" class="form-label">{{ __('Data de Publicação') }}</label>
                                <input type="date" class="form-control  @error('publication_date') is-invalid @enderror"
                                    id="publication_date" name="publication_date">
                                @error('publication_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
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
                                <input type="number" class="form-control  @error('edition') is-invalid @enderror"
                                    id="edition" name="edition" placeholder="1">
                                @error('edition')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="dimension" class="form-label">{{ __('Dimensão') }}</label>
                                <input type="text" class="form-control  @error('dimension') is-invalid @enderror"
                                    id="dimension" name="dimension" placeholder="125 x 110">
                                @error('dimension')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="isbn13" class="form-label">{{ __('ISBN13') }}</label>
                                <input type="text" class="form-control  @error('isbn13') is-invalid @enderror"
                                    id="isbn13" name="isbn13" placeholder="978-66-876549-8-5">
                                @error('isbn13')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="publishing_company" class="form-label">{{ __('Nome da Editora') }}</label>
                                <input type="text"
                                    class="form-control  @error('publishing_company') is-invalid @enderror"
                                    id="publishing_company" name="publishing_company" placeholder="Suma">
                                @error('publishing_company')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="amount" class="form-label">{{ __('Quantidade') }}</label>
                                <input type="number" class="form-control  @error('amount') is-invalid @enderror"
                                    id="amount" name="amount" placeholder="12">
                                @error('amount')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="value" class="form-label">{{ __('Valor') }}</label>
                                <input type="number" step="any"
                                    class="form-control  @error('value') is-invalid @enderror" id="number_wallet"
                                    id="value" name="value" placeholder="70.95">
                                @error('value')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">{{ __('Imagem') }}</label>
                                <input type="file" class="form-control-file" id="image" name="image">
                                @error('image')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
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
