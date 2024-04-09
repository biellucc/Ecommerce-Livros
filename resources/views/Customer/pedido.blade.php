@extends('layouts.main')

@section('title', 'Pedido')

@section('content')

    <div class="container">
        <div class="py-5 text-center">
            <h2>Formulário do Pedido</h2>
        </div>

        <div class="row g-5">
            <div class="col-md-5 col-lg-4 order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-primary">Seu Carrinho</span>
                    <span class="badge bg-primary rounded-pill">{{ $cart->books->count() }}</span>
                </h4>
                <ul class="list-group mb-3">
                    @foreach ($cart->books as $book)
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">{{ $book->title }}</h6>
                                <small class="text-body-secondary">Idioma: {{ $book->language }}</small>
                                <small class="text-body-secondary">Vendedor: {{ $book->vendor->nameBusiness }}</small>
                            </div>
                            <span class="text-body-secondary">${{ $book->value }}</span>
                        </li>
                    @endforeach
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (R$)</span>
                        <strong>${{ $cart->books->sum('value') }}</strong>
                    </li>
                </ul>

            </div>
            <div class="col-md-7 col-lg-8">
                <h4 class="mb-3">Endereço de cobrança</h4>
                <form action="{{ route('order.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="firstName" class="form-label">Primeiro Nome</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" placeholder=""
                                value="{{ $customer->firstName }}">
                            <div class="invalid-feedback">

                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">Segundo Nome</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" placeholder=""
                                value="{{ $customer->lastName }}">
                            <div class="invalid-feedback">

                            </div>
                        </div>


                        <div class="col-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder=""
                                value="{{ $customer->user->email }}">
                            <div class="invalid-feedback">

                            </div>
                        </div>

                        <div class="col-6">
                            <label for="address" class="form-label">Endereço</label>
                            <input type="text" class="form-control" id="neighborhood" name="neighborhood" placeholder=""
                                value="{{ $customer->user->address->neighborhood }}">
                            <div class="invalid-feedback">

                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="n_house" class="form-label">Número da casa</label>
                            <input type="number" class="form-control" id="n_house" name="n_house" placeholder=""
                                value="{{ $customer->user->address->n_house }}">

                            <div class="invalid-feedback">
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label for="complement" class="form-label">Complemento<span> (Opcional)</span></label>
                            <input type="text" class="form-control" id="complement" name="complement" placeholder=""
                                value="{{ $customer->user->address->complement }}">

                            <div class="invalid-feedback">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="state" class="form-label">Estado</label>
                            <input type="text" class="form-control" id="state" name="state" placeholder=""
                                value="{{ $customer->user->address->state }}">

                            <div class="invalid-feedback">
                            </div>
                        </div>

                        <div class="col-md-5">
                            <label for="city" class="form-label">Cidade</label>
                            <input type="text" class="form-control" id="city" name="city" placeholder=""
                                value="{{ $customer->user->address->city }}">
                            <div class="invalid-feedback">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="cep" class="form-label">CEP</label>
                            <input type="text" class="form-control" name="cep" id="cep" placeholder=""
                                value="{{ $customer->user->address->cep }}">
                            <div class="invalid-feedback">

                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h4 class="mb-3">Payment</h4>

                    <div class="my-3">
                        <div class="form-check">
                            <input id="credit" name="paymentMethod" type="radio" class="form-check-input "
                                value='Crédito' checked>
                            <label class="form-check-label" for="credit">Cartão de Crédito</label>
                        </div>
                        <div class="form-check">
                            <input id="debit" name="paymentMethod" type="radio" class="form-check-input"
                                value='Débito'>
                            <label class="form-check-label" for="debit">Cartão de Débito</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="wallet" class="form-label">Cartão</label>
                        <select class="form-select" id="wallet" name="wallet">
                            @foreach ($customer->wallets as $wallet)
                                <div class="wallet" data-categoria="{{ $wallet->type_wallet }}">
                                    <option value="{{ $wallet->id }}">CVC: {{ $wallet->cvc }} <small
                                            class="text-body-secondary"> Número: {{ $wallet->number_wallet }}</small>
                                    </option>
                                </div>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">

                        </div>
                    </div>

                    <hr class="my-4">

                    <input type="hidden" name="cart_id" value="{{ $cart->id }}">
                    <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                    <input type="hidden" name="value" value="{{ $cart->books->sum('value') }}">
                    <button class="w-100 btn btn-primary btn-lg" type="submit">Confirmar Pedido</button>
                </form>
            </div>
        </div>
    </div>
@endsection
