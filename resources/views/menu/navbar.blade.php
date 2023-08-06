<nav class="navbar navbar-expand-lg navbar-dark bg-dark p-3">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('explicacoes') }}"><img src="{{ asset('images/IconEscolaInclusiva.png') }}" alt="Logo" style="height:30px;"> <!-- Imagem aqui -->Escola Inclusiva</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link mx-2" href="{{ route('explicacoes') }}">Explicações</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-2" href="{{ route('noticias') }}">Notícias</a>
                </li>
                @if (Auth::check())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle mx-2" href="#" id="navbarDropdownMenuLink" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li>
                                <a class="dropdown-item" href="{{ route('perfil') }}"><i class="fas fa-user"></i> Perfil</a>
                            </li>
                            @if (auth()->user()->hasRole('admin'))
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i
                                            class="fas fa-user-plus"></i> Dashboard</a>
                                </li>
                            @endif
                            <li>
                                <form action="{{ route('logout') }}" method="get">
                                    @csrf
                                    <button class="dropdown-item" type="submit"><i class="fas fa-sign-out-alt"></i> Sair</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link mx-2" href="{{ route('login') }}">Entrar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mx-2" href="{{ route('register') }}">Registar</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
