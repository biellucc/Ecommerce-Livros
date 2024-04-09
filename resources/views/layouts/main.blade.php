<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS e JS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href="{{ asset('assets/css/estilo.css') }}" rel="stylesheet">

    <title>@yield('title')</title>

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">Bia&BielCompany</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/">Home</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">Contato</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#email">Email</a></li>
                                <li><a class="dropdown-item" href="#telefone">Telefone</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown"
                                data-bs-auto-close="outside" aria-expanded="false">Usuário</a>
                            <ul class="dropdown-menu">
                                @guest
                                    <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                                    <li><a class="dropdown-item" href="{{ route('register') }}">Registrar</a></li>
                                @else
                                    <li><a class="dropdown-item" href="profile">Perfil</a></li>
                                    <!-- Verifica se o user está conectado e se é um Vendor ou Cliente-->
                                    @if (Auth::check() && Auth::user()->vendor)
                                        <li><a class="dropdown-item" href="{{ route('livro.forms') }}">Cadastrar Livro</a>
                                        </li>
                                        <li><a class="dropdown-item" href="{{ route('vendor.listaMeusLivros') }}">Livros
                                                Cadastrados</a></li>
                                    @else
                                        <!-- Submenu do Cartão -->
                                        <li>
                                            <a class="dropdown-item dropdown-toggle" data-bs-toggle="dropdown"
                                                href="#" aria-expanded="false">Cartão</a>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="{{ route('wallet.forms') }}">Cadastrar
                                                        Cartão</a></li>
                                                <li><a class="dropdown-item" href="{{ route('wallet.lista') }}">Cartões
                                                        Cadastrados</a></li>
                                            </ul>
                                        </li>
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

                    <div class="d-flex container  justify-content-end">
                        <div class="row">

                            @if (Auth::check() && Auth::user()->customer)
                                <div class="col-md-2 ">
                                    <a href="{{ route('carrinho') }}"><i class='bx bx-cart' style="font-size:36px;"></i></a>
                                </div>
                            @endif

                            <div class="col-md-10">
                                <form class="d-flex" role="search" method="GET" action="{{ route('site.search') }}">
                                    <input class="form-control me-2" type="search" placeholder="Pesquisar"
                                        aria-label="Search" name="search">
                                    <button class="btn btn-outline-success" type="submit">Pesquisar</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </nav>
    </header>

    @yield('content')

    <footer id="footer" class="py-3 my-4 bg-body-tertiary">
        <p class="text-center text-body-secondary"><strong>Email: </strong>bia&biel@company.com</p>
        <p class="text-center text-body-secondary"><strong>Telefone: </strong>(19)9976-654</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>

</html>
