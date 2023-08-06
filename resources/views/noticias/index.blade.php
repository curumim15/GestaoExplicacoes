<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('js/navbar.js') }}">
    <link rel="stylesheet" href="{{ asset('css/explicacoesprincipal.css') }}">
    <link rel="icon" href="{{asset('images/IconEscolaInclusiva.png')}}">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <!-- SweetAlert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.7/dist/sweetalert2.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.7/dist/sweetalert2.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


    <title>Escola Inclusiva - Página Inicial</title>
</head>
<body>
@include('menu.navbar')

<div class="container m-5">
    <h1>
        Notícias
    </h1>
    <div class="row m-2">
        @foreach ($noticias as $noticia)
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow h-100" style="cursor: pointer;">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#noticiaModal{{ $noticia->id }}" style="text-decoration: none; color: inherit;">
                        <div class="position-relative overflow-hidden" style="height: 200px;">
                            <img src="{{ asset($noticia->imagem) }}" alt="News Image" class="img-fluid w-100 h-100" style="object-fit: cover; object-position: center;">
                            <div class="position-absolute bottom-0 start-0 p-3" style="background-color: rgba(0,0,0,0.7);">
                                <h5 class="text-white mb-0">{{ $noticia->titulo }}</h5>
                                <small class="text-light">{{ $noticia->created_at->format('d M, Y') }}</small>
                            </div>
                        </div>
                    </a>
                    <div class="card-body">
                        <p class="card-text">{{ Str::limit($noticia->assunto, 100, '...') }}</p>
                    </div>
                    <div class="card-footer bg-transparent border-top-0 d-flex justify-content-between align-items-center">
                        <small class="text-muted">{{ ($noticia->user)->name }}</small>
                        @if($noticia->created_at->gt(\Carbon\Carbon::now()->subDays(2)))
                            <div class="badge border border-secondary text-secondary">Novo</div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="noticiaModal{{ $noticia->id }}" tabindex="-1" role="dialog" aria-labelledby="noticiaModalLabel{{ $noticia->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="noticiaModalLabel{{ $noticia->id }}">{{ $noticia->titulo }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="overflow-y: auto; max-height: calc(100vh - 212px);">
                            <div class="d-flex justify-content-center mb-3">
                                <img src="{{ asset($noticia->imagem) }}" alt="News Image" class="img-fluid" style="max-width: 100%; height: auto;">
                            </div>
                            <hr>
                            <h6><strong>Assunto</strong></h6>
                            <p>{{ $noticia->assunto }}</p>
                            <hr>
                            <h6><strong>Descrição</strong></h6>
                            <p>{{ $noticia->descricao }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
            @if ($noticias->hasPages())
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        {{-- Previous Page Link --}}
                        @if ($noticias->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">Anterior</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $noticias->previousPageUrl() }}"
                                   rel="prev">Anterior</a>
                            </li>
                        @endif
                        {{-- Pagination Elements --}}
                        @foreach (range(1, $noticias->lastPage()) as $page)
                            @if ($page == $noticias->currentPage())
                                <li class="page-item active">
                                    <span class="page-link">{{ $page }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $noticias->url($page) }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                        {{-- Next Page Link --}}
                        @if ($noticias->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $noticias->nextPageUrl() }}" rel="next">Próximo</a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">Próximo</span>
                            </li>
                        @endif
                    </ul>
                </nav>
            @endif
    </div>
</div>

@if (Auth::check() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('professor')))
    <div style="position:fixed; bottom:20px; right:20px;">
        <button type="button" class="btn btn-info m-3" data-bs-toggle="modal" data-bs-target="#criarNoticiaModal" style="border-radius:50%; width:60px; height:60px;">
            <i class="fas fa-plus"></i>
        </button>
    </div>
@endif

<style>
    .card {
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .card:hover {
        transform: scale(1.05);
    }

    .card-img-top {
        height: 200px; /* Adjust the height as needed */
        object-fit: cover;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }

    .card-body {
        padding: 10px;
    }

    .card-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .card-text {
        font-size: 14px;
    }
</style>

<div class="modal fade" id="criarNoticiaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="exampleModalLabel">Criar Nova Notícia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulário para criar a explicação -->
                <form action="{{ route('noticias.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" required maxlength="20">
                    </div>
                    <div class="mb-3">
                        <label for="assunto" class="form-label">Assunto</label>
                        <input type="text" class="form-control" id="assunto" name="assunto" required maxlength="100">
                    </div>
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição</label>
                        <textarea class="form-control" id="descricao" name="descricao" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="imagem" class="form-label">Imagem</label>
                        <input type="file" class="form-control-file" id="imagem" name="imagem">
                    </div>
                    <button type="submit" class="btn btn-info">Cria Noticia</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
</html>
