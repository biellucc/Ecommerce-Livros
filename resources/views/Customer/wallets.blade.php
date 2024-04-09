@extends('layouts.main')
@section('title', 'Meus Cartões')
@section('content')

    <main>

        <div class="d-flex justify-content-center mt-4">
            <h2>Cartões Cadastrados</h2>
        </div>

        <div class="container mt-3">
            <div class="row">

                @foreach ($wallets as $wallet)
                    <div class="col-md-4 mb-3">
                        <div class="card border border-dark-subtle shadow p-3 mb-5 bg-body-tertiary rounded">
                            <div class="card-body">
                                <div class="d-flex justify-content-center">
                                    <h5 class="card-title">{{ $wallet->number_wallet }}</h5>
                                </div>

                                <div class="d-flex justify-content-center">
                                    <h5 class="card-title">{{ $wallet->type_wallet }}</h5>
                                </div>

                                <div class="container">
                                    <div class="row">
                                        <div class="col-4">
                                            <p class="card-text"><strong>CVC: </strong>{{ $wallet->cvc }}</p>
                                        </div>
                                        <div class="col-8">
                                            <p class="card-text"><strong>Validade: </strong>{{ $wallet->validate }}</p>
                                        </div>
                                    </div>
                                </div>

                                <form action="{{ route('wallet.up_rm') }}" method="GET">
                                    @csrf

                                    <div class="d-flex container mt-2">
                                        <div class="row">

                                            <div class="col-9">
                                                <input type="hidden" name="wallet_id" value="{{ $wallet->id }}">
                                                <button type="button" class="btn btn-outline-info" data-bs-toggle="modal"
                                                    data-bs-target="#modalWalletUpdate{{ $wallet->id }}">Alterar</button>
                                            </div>

                                            <div class="col-3">
                                                <input type="hidden" name="wallet_id" value="{{ $wallet->id }}">
                                                <input type="submit"class="btn btn-outline-danger" name="action"
                                                    value="Deletar"></input>
                                            </div>
                                        </div>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>

        <!-- Modal Atualizar Wallet -->
        <div class="modal fade" id="modalWalletUpdate{{ $wallet->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modalWalletUpdateLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalWalletUpdateLabel">Alterar Cartão</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('wallet.up_rm') }}" method="GET">
                            @csrf
                            <div class="form-group">
                                <label for="cvc">CVC</label>
                                <input type="text" class="form-control" id="cvc" name="cvc"
                                    placeholder="{{ $wallet->cvc }}">
                            </div>
                            <div class="form-group mt-2">
                                <label type="text" for="number_wallet">Número do
                                    Cartão</label>
                                <input class="form-control" id="number_wallet" name="number_wallet"
                                    placeholder="{{ $wallet->number_wallet }}">
                            </div>
                            <div class="form-group mt-2">
                                <label type="text" for="validate">Validade</label>
                                <input class="form-control" id="validate" name="validate"
                                    placeholder="{{ $wallet->validate }}">
                            </div>
                            <div class="form-group mt-2">
                                <label for="type_wallet" class="form-label">Tipo de Cartão</label>
                                <select class="form-select" id="type_wallet" name="type_wallet">
                                    <option value="Crédito">Crédito</option>
                                    <option value="Débito">Débito</option>
                                </select>
                            </div>
                            <input type="hidden" name="wallet_id" value="{{ $wallet->id }}">
                            <input type="submit" class="btn btn-primary mt-3" name="action" value="Salvar"></input>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>


@endsection
