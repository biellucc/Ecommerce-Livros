@extends('layouts.main')

@section('title', 'Resultado da Pesquisa {{ $dados }}')

@section('content')

    <main>
        @if ($searchs->isEmpty())
            <div class="d-flex justify-content-center mt-4">
                <h3>Livro '{{ $dado }}' não foi encontrado</h3>
            </div>
        @else
            <div class="album py-5">
                <div class="container">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                        @foreach ($searchs as $book)
                            <div class="col">
                                <div class="card shadow-sm">
                                    <svg width="100%" height="225" xmlns="http://www.w3.org/2000/svg">
                                        <image href="/assets/imagem/{{ $book->image }}" width="100%" height="100%"
                                            preserveAspectRatio="xMidYMid slice" />
                                    </svg>
                                    <div class="card-body">
                                        <p class="card-text"><strong>{{ $book->title }}</strong></p>
                                        <p class="card-text">{{ $book->summary }}</p>
                                        <p class="card-text"><strong>Valor: R${{ $book->value }}</strong></p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <a href="{{ route('site.view', ['id' => $book->id]) }}"
                                                    class="btn bg-body-tertiary">Saber
                                                    mais</a>
                                            </div>
                                            <small class="text-body-secondary"> {{ $book->created_at }} </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </main>

@endsection
