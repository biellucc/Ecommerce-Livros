@extends('layouts.main')

@section('title', 'Detalhes do Produto')

@section('content')
<div class="container">
    <div class="row mt-4">

         <!--Imagem do Livro-->
        <div class="col-md-6">
            <div class="card">
                <img src="{{ asset($book->image) }}" class="card-img-top" alt="Imagem do Livro">
            </div>
        </div>

         <!--Informações do Livro-->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $book->title }}</h5>
                    <p class="card-text"><strong>Autor:</strong> {{ $book->author }}</p>
                    <p class="card-text"><strong>Quantidade de Páginas:</strong> {{ $book->pages }}</p>
                    <p class="card-text"><strong>Valor:</strong> R$ {{ number_format($book->value, 2, ',', '.') }}</p>
                </div>
            </div>

             <!--Resumo do Livro-->
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title">Resumo do Livro</h5>
                    <p class="card-text">{{ $book->summary }}</p>
                </div>
            </div>

            <!--Informações do Vendedor-->
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title">Informações do Vendedor</h5>
                    <p class="card-text"><strong>Nome:</strong> {{ $book->vendor->nameBussines }}</p>
                    <p class="card-text"><strong>CNPJ:</strong> {{ $book->vendor->cnpj }}</p>
                    <p class="card-text"><strong>Localização:</strong> {{ $book->vendor->user->address->city }}, {{ $book->vendor->user->address->state }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @if (Auth::check() && Auth::user()->customer)
           @if($book->amount > 0)

                <div class="col-md-2">
                    <a href="/comprar{{ $book->id }}" class="btn btn-primary">Comprar</a>
                </div>

                <div class="col-md-4">
                @php
                    $customerId = Auth::user()->customer->user_id;
                    $bookId = $book->id;
                    $cartExists = App\Models\Cart::where('customer_id', $customerId)->exists();
                    $cartBookExists = App\Models\Cart::where('customer_id', $customerId)
                        ->whereHas('books', function ($query) use ($bookId) {
                            $query->where('books.id', $bookId);
                        })
                        ->exists();
                @endphp

                @if ($cartExists && $cartBookExists)
                    <form action="{{ route('cart.rm', $book) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Remover do Carrinho</button>
                    </form>
                @else
                    <form action="{{ route('cart.add', $book) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Adicionar ao Carrinho</button>
                    </form>
                @endif

           @else
               <div class="col-md-4">
                  <button class="btn btn-primary" disabled>Esgotado</button>
               </div>
           @endif

        @endif
        </div>
    </div>

    <!--Seçaõ de Comentários-->
    <section id="coments">
        <hr>
        <div class="row">
            <div class="col-md-2">
                <h4 class="coments">Comentários</h4>
            </div>
            <div class="col-md-2 action">
                @if (Auth::check() && Auth::user()->customer)
                    <button type="button" class="btn bg-body-tertiary" data-bs-toggle="modal" data-bs-target="#modalComents">
                        Comentar
                    </button>
                @endif
            </div>
        </div>

        <div id="card-container" class="row">
            @foreach ($book->comments as $comment)
                <div class="card col-md-3 mt-4 mx-4">
                    <div class="card-body">
                        <p class="card-text"><strong>{{ $comment->customer->firstName }} {{ $comment->customer->lastName }}</strong></p>
                        <p class="card-text"><strong>{{ $comment->title }} - Date {{ $comment->created_at }}</strong></p>
                        <p class="card-text">{{ $comment->body }}</p>
                        @if (Auth::check() && Auth::user() && $comment->customer_id == Auth::user()->customer->user_id)
                            <div class="col-md-2">
                                <form action="{{ route('comment.rm', ['id' => $book->id, 'id_cm' => $comment->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Deletar</button>
                                </form>
                            </div>
                            <div class="col-md-2 mt-2">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalComentsUpdate">
                                    Atualizar
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </section>

</div>

<!-- Modal Comments -->
<div class="modal fade" id="modalComents" tabindex="-1" role="dialog" aria-labelledby="modalComentsLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalComentsLabel">Adicionar Comentário: {{ $book->title }}</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('comment.add', ['id' => $book->id]) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="commentTitle">Título</label>
                        <input type="text" class="form-control" id="commentTitle" name="commentTitle" required>
                    </div>
                    <div class="form-group mt-2">
                        <label for="commentBody">Comentário</label>
                        <textarea class="form-control" id="commentBody" name="commentBody" rows="4" required></textarea>
                    </div>
                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                    <button type="submit" class="btn btn-primary mt-3">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Atualizar Comments -->
<div class="modal fade" id="modalComentsUpdate" tabindex="-1" role="dialog" aria-labelledby="modalComentsUpdateLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalComentsUpdateLabel">Atualizar Comentário: {{ $book->title }}</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('comment.up', ['id' => $book->id, 'id_cm' => $comment->id]) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">Título</label>
                        <input type="text" class="form-control" id="title" name="title">
                    </div>
                    <div class="form-group mt-2">
                        <label for="body">Comentário</label>
                        <textarea class="form-control" id="body" name="body" rows="4"></textarea>
                    </div>
                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                    <button type="submit" class="btn btn-primary mt-3">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
