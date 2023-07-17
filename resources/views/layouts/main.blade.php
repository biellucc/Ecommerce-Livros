<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS e JS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="{{ asset('/css/estilo.css') }}" rel="stylesheet">

    <title>@yield('tittle')</title>

</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Bia&BielCompany</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Contato</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#endereco">Endereço</a></li>
                            <li><a class="dropdown-item" href="#email">Email</a></li>
                            <li><a class="dropdown-item" href="#telefone">Telefone</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Usuário</a>
                        <ul class="dropdown-menu">
                            @guest
                            <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                            <li><a class="dropdown-item" href="{{ route('register') }}">Registrar</a></li>
                            @else
                            <li><a class="dropdown-item" href="profile">Perfil</a></li>
                            <!-- Verifica se o user está conectado e se é um Vendor ou Cliente-->
                            @if (Auth::check() && Auth::user()->vendor)
                            <li><a class="dropdown-item" href="/cadastroBook">Cadastrar Livros</a></li>
                            <li><a class="dropdown-item" href="/livrosCadastrados">Livros Cadastrados</a></li>
                            @else
                            <li><a class="dropdown-item" href="/carrinho">Meu Carrinho</a></li>
                            @endif
                            <li class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="dropdown-item">
                                    @csrf
                                    <button type="submit" class="btn btn-link">Sair</button>
                                </form>
                            </li>
                            @endguest
                        </ul>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Pesquisar</button>
                </form>
            </div>
        </div>
    </nav>
</header>

@yield('content')

<footer id="footer" class="py-3 my-4 bg-body-tertiary">
    <ul class="nav justify-content-center border-bottom pb-3 mb-3">
        <li class="nav-item"><a id="home" href="#" class="nav-link px-2 text-body-secondary">Casa</a></li>
        <li class="nav-item"><a id="perguntas" href="#" class="nav-link px-2 text-body-secondary">Perguntas Frequentes</a></li>
        <li class="nav-item"><a id="sobre" href="#" class="nav-link px-2 text-body-secondary">Sobre</a></li>
    </ul>
    <p class="text-center text-body-secondary"><strong>Endereço: </strong>xxx</p>
    <p class="text-center text-body-secondary"><strong>Email: </strong>bia&biel@company.com</p>
    <p class="text-center text-body-secondary"><strong>Telefone: </strong>(19)9976-654</p>
    <p class="text-center text-body-secondary"><strong>© Bia&BielCompany</strong></p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
