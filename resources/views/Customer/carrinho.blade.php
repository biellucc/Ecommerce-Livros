@extends('layouts.main')
@section('title', 'Minhas Compras')
@section('content')

<div id="livros-container" class="col-md-12 text-center">
    <h2 class="mt-4">Meu Carrinho</h2>
    <div id="card-container" class="row">
        @foreach ($carts as $cart)
            <div class="card col-md-3 mt-4 mx-4">
                @foreach ($cart->books as $book)
                    <img src="{{ asset($book->image) }}" class="card-img-top" alt="Imagem do Livro">
                    <div class="card-body">
                        <p class="card-title"><strong>Título: </strong>{{ $book->title }}</p>
                        <p class="card-text"><strong>Valor: </strong>{{ $book->value }}</p>
                        <p class="card-text"><strong>Adicionado em: </strong>{{ $cart->data }}</p>
                        <form action="{{ route('cart.rm', $book) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">Remover</button>
                        </form>
                        <a href="/produto{{ $book->id }}" class="btn bg-body-tertiary mt-2">Saber mais</a>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>

@endsection
