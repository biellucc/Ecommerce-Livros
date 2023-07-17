@extends('layouts.main')

@section('title', 'Registrar')

@section('content')
<div class="container">
    <form action="{{ route('register') }}" method="POST">
        @csrf
                 <!-- Dados do Usuário -->
        <h2 class="mt-4 text-center">Dados do Usuário</h2>

        <div class="row">
            <div class="col-md-6-mb-3">
                <label for="userType" class="form-label">Escolha o tipo de usuário:</label>
                <select class="form-select" id="userType" name="userType" onchange="showFields(this.value)">
                    <option value="customer">Cliente</option>
                    <option value="vendor">Vendedor</option>
                </select>
            </div>

            <div class="col-mb-3">
                <div id="customerFields" style="display: none">

                    <div class="row mt-2">
                        <div class="col-md-6 mb-3">
                            <label for="firstName" class="form-label">Primeiro Nome:</label>
                            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Gabriel" >
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName" class="form-label">Segundo Nome:</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Santos" >
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cpf" class="form-label">CPF:</label>
                            <input type="text" class="form-control" id="cpf" name="cpf" placeholder=" 123.456.789-00" >
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="birthday" class="form-label">Aniversário:</label>
                            <input type="date" class="form-control" id="birthday" name="birthday" >
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="agender" class="form-label">Seu gênero</label>
                            <select class="form-select" id="agender" name="agender">
                                <option value="masculino">Masculino</option>
                                <option value="feminino">Feminino</option>
                            </select>
                        </div>
                     </div>

                </div>

                <div id="vendorFields" style="display: none">
                    <div class="row mt-2">
                        <div class="col-md-6 mb-3">
                            <label for="cnpj" class="form-label">CNPJ:</label>
                            <input type="text" class="form-control" id="cnpj" name="cnpj" placeholder=" 12.345.678/0001-00" >
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nameBussines" class="form-label">Nome da Empresa:</label>
                            <input type="text" class="form-control" id="nameBussines" name="nameBussines" placeholder="XYCompany" >
                        </div>
                     </div>
                </div>

            </div>
        </div>

        <!-- Contato do Usuário -->
        <h2 class="mt-4 text-center">Contato do Usuário</h2>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="gabriel@santos.com.br" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="phone" class="form-label">Telefone:</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="55 (19) 9999-9999" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="password" class="form-label">Senha (Min 8 digítos):</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="password_confirmation" class="form-label">Confirmar Senha:</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>
        </div>

        <!-- Dados do Endereço -->
        <h2 class="mt-4 text-center">Dados do Endereço</h2>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="cep" class="form-label">CEP:</label>
                <input type="text" class="form-control" id="cep" name="cep" placeholder=" 13025-085" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="neighborhood" class="form-label">Bairro:</label>
                <input type="text" class="form-control" id="neighborhood" name="neighborhood" placeholder="Cambuí" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="state" class="form-label">Estado:</label>
                <input type="text" class="form-control" id="state" name="state" placeholder="São Paulo" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="city" class="form-label">Cidade:</label>
                <input type="text" class="form-control" id="city" name="city" placeholder="Campinas" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="n_house" class="form-label">Número da Residência:</label>
                <input type="text" class="form-control" id="n_house" name="n_house" placeholder="12" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="complement" class="form-label">Complemento (Opcional):</label>
                <input type="text" class="form-control" id="complement" name="complement">
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                showFields(document.getElementById('userType').value);
            });

            function showFields(userType) {
                if (userType === 'customer') {
                    document.getElementById('customerFields').style.display = 'block';
                    document.getElementById('vendorFields').style.display = 'none';
                } else if (userType === 'vendor') {
                    document.getElementById('customerFields').style.display = 'none';
                    document.getElementById('vendorFields').style.display = 'block';
                } else {
                    document.getElementById('customerFields').style.display = 'none';
                    document.getElementById('vendorFields').style.display = 'none';
                }
            }
        </script>

        <div class="row">
            <div class="col text-center">
                <button type="submit" class="btn btn-primary mt-4">Enviar</button>
            </div>
        </div>
    </form>
</div>
@endsection
