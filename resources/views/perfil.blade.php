<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('js/navbar.js') }}">
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
    <link rel="icon" href="{{asset('images/IconEscolaInclusiva.png')}}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Escola Inclusiva - Perfil</title>
</head>
<body>

@include('menu.navbar')

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Sucesso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ session('success') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Fechar</button>
            </div>
        </div>
    </div>
</div>

<!-- Error Modal -->
<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorModalLabel">Erro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ session('error') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Fechar</button>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="main-body">
        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card shadow-lg">
                    <div class="card-body d-flex flex-column align-items-center text-center p-5">
                        <img src="{{ asset(Auth::user()->avatar) }}" alt="Admin" class="rounded-circle img-thumbnail mb-3" style="width:160px; height:160px;">
                        <h4>{{ Auth::user()->name }}</h4>
                        <p class="text-secondary mb-2">{{ ucfirst(Auth::user()->role->nome) }}</p>
                        @if(Auth::user()->role_id == 3)
                            <p class="d-inline alert alert-success px-2 py-1 mb-2" role="alert">Crédito: <strong>{{ Auth::user()->credito }}</strong>
                                <i class="fas fa-plus" data-bs-toggle="modal" data-bs-target="#carregarModal"></i></p>
                        @endif
                        <div class="text-start mb-3">
                            <p><i class="fas fa-venus-mars me-2"></i> {{ ucfirst(Auth::user()->genero) }}</p>
                            <p><i class="far fa-calendar-alt me-2"></i> {{ date('d-m-Y',strtotime(auth()->user()->dataNascimento)) }}</p>
                            <p><i class="far fa-envelope me-2"></i> {{ Auth::user()->email }}</p>
                            <p><i class="fas fa-phone me-2"></i> {{ Auth::user()->telemovel }}</p>
                        </div>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <button type="button" class="btn btn-outline-success m-2" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fas fa-edit"></i>Editar</button>
                            @if(auth()->user()->associados()->exists())
                            <div class="m-2 border border-warning p-2 align-content-center">
                                <strong>Associado</strong>
                            </div>
                            @else
                                @if(auth()->user()->associado)
                                <div class="m-2 border border-warning p-2 align-content-center">
                                    <strong>Aguardar associado</strong>
                                </div>

                            @else
                                <button type="button" class="btn btn-outline-secondary m-2" data-bs-toggle="modal" data-bs-target="#associarModal"><i class="fas fa-plus"></i> Associar</button>
                            @endif
                            @endif

                        @if(Auth::user()->role_id == 2)
                            <button type="button" class="btn btn-outline-primary m-2" data-bs-toggle="modal" data-bs-target="#noticiasModal"><i class="fas fa-newspaper"></i> Noticias</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 mb-3">
                                <div class="card w-100 mt-3 shadow-sm border-light">
                                    <div class="card-header bg-light text-dark">
                                        <h5 class="card-title">Explicações</h5>
                                    </div>
                                    <div class="card-body">
                                        @if(Auth::user()->role_id == 2)
                                            @foreach ($explicacoes as $explicacao)
                                                <div class="card mb-4 shadow-lg border-0 rounded">
                                                    <div class="card-body">
                                                        <h6 class="card-title font-weight-bold text-uppercase text-primary mb-3">{{ $explicacao->disciplina }}</h6>
                                                        <hr>
                                                        <p class="card-text text-muted mb-1"><i class="fas fa-money-bill-wave text-primary"></i> Preço: <strong>{{ $explicacao->preco }}</strong></p>
                                                        <p class="card-text text-muted mb-1"><i class="fas fa-users text-primary"></i> Máximo de Alunos: <strong>{{ $explicacao->max_alunos }}</strong></p>
                                                        <div class="mb-3">
                                                            <h6 class="mb-2 text-secondary"><i class="bi bi-calendar3"></i> Disponibilidade:</h6>
                                                            @php
                                                                $dayNames = ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'];
                                                                $disponibilidadesGrouped = [];
                                                            @endphp

                                                            @foreach($explicacao->disponibilidades as $disponibilidade)
                                                                @if($disponibilidade->dia >= 1 && $disponibilidade->dia <= 7)
                                                                    @php
                                                                        $disponibilidadesGrouped[$disponibilidade->dia][] = date('H:i', strtotime($disponibilidade->hora));
                                                                    @endphp
                                                                @endif
                                                            @endforeach

                                                            <!-- Button to open modal -->
                                                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#timesModal{{ $explicacao->id }}">Ver todas as horas</button>
                                                            <!-- Modal to show all times -->
                                                            <div class="modal fade" id="timesModal{{ $explicacao->id }}" tabindex="-1" aria-labelledby="timesModalLabel{{ $explicacao->id }}" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="timesModalLabel{{ $explicacao->id }}">Horas Disponíveis</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            @foreach($disponibilidadesGrouped as $dia => $horas)
                                                                                <h6 class="text-dark font-italic">{{ $dayNames[$dia - 1] }}:</h6>
                                                                                @foreach($horas as $hora)
                                                                                    <span class="badge bg-primary">{{ $hora }}</span>
                                                                                @endforeach
                                                                                <br>
                                                                            @endforeach
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <p class="card-text text-muted mb-3"><i class="fas fa-info-circle text-primary"></i> Descrição: <strong>{{ $explicacao->descricao }}</strong></p>
                                                        <!-- Edit and Delete buttons -->
                                                        <div class="m-2">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <a href="" class="btn btn-outline-success btn-sm w-100 me-2" data-bs-toggle="modal"
                                                                       title="Editar Explicação"
                                                                       data-bs-target="#editarExplicacaoModal{{ $explicacao->id }}">
                                                                        <i class="fas fa-edit"></i>
                                                                    </a>
                                                                </div>
                                                                <div class="col">
                                                                    <a href="" class="btn btn-outline-danger btn-sm w-100 me-2" data-bs-toggle="modal"
                                                                       title="Apagar Explicação"
                                                                       data-bs-target="#excluirExplicacaoModal{{ $explicacao->id }}">
                                                                        <i class="fas fa-trash"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Modal para editar a explicação -->
                                                    <div class="modal fade" id="editarExplicacaoModal{{ $explicacao->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Editar Explicação</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="container-fluid">

                                                                        <!-- Formulário para editar a explicação -->
                                                                        <form action="{{ route('explicacoes.updatePerfil', $explicacao->id) }}" method="POST">
                                                                            @csrf
                                                                            <div class="row">
                                                                                <div class="col-6">
                                                                                    <div class="mb-3">
                                                                                        <label for="disciplina" class="form-label">Disciplina</label>
                                                                                        <input type="text" class="form-control" id="disciplina" name="disciplina"
                                                                                               value="{{ $explicacao->disciplina }}" required>
                                                                                    </div>
                                                                                    <div class="mb-3">
                                                                                        <label for="max_alunos" class="form-label">Número Máximo de Alunos</label>
                                                                                        <input type="number" class="form-control" id="max_alunos" name="max_alunos"
                                                                                               min="1" value="{{ $explicacao->max_alunos }}"
                                                                                               oninput="validity.valid||(value='');" required>
                                                                                    </div>
                                                                                    <div class="mb-3">
                                                                                        <label for="descricao" class="form-label">Descrição</label>
                                                                                        <textarea class="form-control" id="descricao" name="descricao"
                                                                                                  required>{{ $explicacao->descricao }}</textarea>
                                                                                    </div>
                                                                                    <div class="mb-3">
                                                                                        <label for="preco" class="form-label">Preço por hora</label>
                                                                                        <input type="number" step="0.01" class="form-control" id="preco" name="preco"
                                                                                               value="{{ $explicacao->preco }}" required>
                                                                                    </div>
                                                                                    <button type="submit" class="btn btn-primary">Atualizar</button>

                                                                                </div>
                                                                                <div class="col-6">
                                                                                    <!-- Seção para editar disponibilidades -->
                                                                                    @foreach ($explicacao->disponibilidades as $disponibilidade)
                                                                                        @php
                                                                                            $dayNames = ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'];
                                                                                        @endphp
                                                                                        <div class="card mt-3">
                                                                                            <div class="card-header">{{ $dayNames[$disponibilidade->dia - 1] }}</div>
                                                                                            <div class="card-body">
                                                                                                <div class="row">
                                                                                                    <div class="col-6">
                                                                                                        <label for="dia_{{ $disponibilidade->id }}" class="form-label">Dia</label>
                                                                                                        <select class="form-control" id="dia_{{ $disponibilidade->id }}" name="dia_{{ $disponibilidade->id }}" required>
                                                                                                            @foreach ($dayNames as $index => $dayName)
                                                                                                                <option value="{{ $index+1 }}" {{ $disponibilidade->dia == $index+1 ? 'selected' : '' }}>{{ $dayName }}</option>
                                                                                                            @endforeach
                                                                                                        </select>
                                                                                                    </div>
                                                                                                    <div class="col-6">
                                                                                                        <label for="hora_{{ $disponibilidade->id }}" class="form-label">Hora</label>
                                                                                                        <input type="time" class="form-control" id="hora_{{ $disponibilidade->id }}" name="hora_{{ $disponibilidade->id }}" value="{{ date('H:i', strtotime($disponibilidade->hora)) }}" required>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal para excluir a explicação -->
                                                <div class="modal fade" id="excluirExplicacaoModal{{ $explicacao->id }}" tabindex="-1"
                                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Excluir Explicação</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Tem certeza de que deseja excluir esta explicação?</p>
                                                                <form action="{{ route('explicacoes.deletePerfil', $explicacao->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">Excluir</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                </div>

                                            @endforeach

                                                @if ($explicacoes->hasPages())
                                                    <nav aria-label="Page navigation">
                                                        <ul class="pagination justify-content-center">
                                                            {{-- Previous Page Link --}}
                                                            @if ($explicacoes->onFirstPage())
                                                                <li class="page-item disabled">
                                                                    <span class="page-link">Anterior</span>
                                                                </li>
                                                            @else
                                                                <li class="page-item">
                                                                    <a class="page-link" href="{{ $explicacoes->previousPageUrl() }}"
                                                                       rel="prev">Anterior</a>
                                                                </li>
                                                            @endif
                                                            {{-- Pagination Elements --}}
                                                            @foreach (range(1, $explicacoes->lastPage()) as $page)
                                                                @if ($page == $explicacoes->currentPage())
                                                                    <li class="page-item active">
                                                                        <span class="page-link">{{ $page }}</span>
                                                                    </li>
                                                                @else
                                                                    <li class="page-item">
                                                                        <a class="page-link" href="{{ $explicacoes->url($page) }}">{{ $page }}</a>
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                            {{-- Next Page Link --}}
                                                            @if ($explicacoes->hasMorePages())
                                                                <li class="page-item">
                                                                    <a class="page-link" href="{{ $explicacoes->nextPageUrl() }}" rel="next">Próximo</a>
                                                                </li>
                                                            @else
                                                                <li class="page-item disabled">
                                                                    <span class="page-link">Próximo</span>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    </nav>
                                                @endif
                                        @else
                                            @if($compras->count() <= 0)
                                                <h6 class="card-title font-weight-bold text-uppercase mb-1 border-bottom pb-1">Não compraste nenhuma explicação</h6>
                                            @else
                                            @foreach ($compras as $compra)
                                                    <div class="card mb-4 shadow-lg border-0 rounded">
                                                    <div class="card-body">
                                                        <h6 class="card-title font-weight-bold text-uppercase text-primary mb-1 border-bottom pb-1">{{ $compra->explicacao->disciplina }}</h6>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="section">
                                                                    <h6 class="section-title font-weight-bold text-primary mt-2"><i class="fas fa-money-bill-wave"></i> Preço da Explicação</h6>
                                                                    <div class="section-content">
                                                                        <strong>{{ $compra->explicacao->preco }}</strong>
                                                                    </div>
                                                                </div>
                                                                <div class="section">

                                                                    <h6 class="section-title font-weight-bold text-primary mt-2"><i class="fas fa-users"></i> Contactos</h6>
                                                                    <div class="section-content">
                                                                        <div><strong>Nome:</strong> {{ $compra->explicacao->user->name }}</div>
                                                                        <div><strong>Email:</strong> {{ $compra->explicacao->user->email }}</div>
                                                                        <div><strong>Telemóvel:</strong> {{ $compra->explicacao->user->telemovel }}</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="section">
                                                                    <h6 class="section-title font-weight-bold text-primary mt-2"><i class="fas fa-calendar-alt"></i> Data e Hora</h6>
                                                                    <div class="section-content">
                                                                        <strong>{{ date('d/m/Y H:i', strtotime($compra->explicacao->data_hora)) }}</strong>
                                                                    </div>
                                                                </div>
                                                                <div class="section">
                                                                    <h6 class="section-title font-weight-bold text-primary mt-2"><i class="fas fa-info-circle"></i> Descrição</h6>
                                                                    <div class="section-content">
                                                                        <strong>{{ $compra->explicacao->descricao }}</strong>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                                @if ($compras->hasPages())
                                                    <nav aria-label="Page navigation">
                                                        <ul class="pagination justify-content-center">
                                                            {{-- Previous Page Link --}}
                                                            @if ($compras->onFirstPage())
                                                                <li class="page-item disabled">
                                                                    <span class="page-link">Anterior</span>
                                                                </li>
                                                            @else
                                                                <li class="page-item">
                                                                    <a class="page-link" href="{{ $compras->previousPageUrl() }}"
                                                                       rel="prev">Anterior</a>
                                                                </li>
                                                            @endif
                                                            {{-- Pagination Elements --}}
                                                            @foreach (range(1, $compras->lastPage()) as $page)
                                                                @if ($page == $compras->currentPage())
                                                                    <li class="page-item active">
                                                                        <span class="page-link">{{ $page }}</span>
                                                                    </li>
                                                                @else
                                                                    <li class="page-item">
                                                                        <a class="page-link" href="{{ $compras->url($page) }}">{{ $page }}</a>
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                            {{-- Próxima página Link --}}
                                                            @if ($compras->hasMorePages())
                                                                <li class="page-item">
                                                                    <a class="page-link" href="{{ $compras->nextPageUrl() }}" rel="next">Próximo</a>
                                                                </li>
                                                            @else
                                                                <li class="page-item disabled">
                                                                    <span class="page-link">Próximo</span>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    </nav>
                                                @endif
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Noticias Modal -->
            <div class="modal fade" id="noticiasModal" tabindex="-1" aria-labelledby="noticiasModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="comprasModalLabel">As minhas Noticias</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                @foreach ($noticias as $noticia)
                                    <div class="col-sm-6 col-lg-4 mb-4">
                                        <div class="card border-0 shadow-lg rounded h-100">
                                            <img class="card-img-top" src="{{ $noticia->imagem }}" alt="Card image" style="height: 200px; object-fit: cover;">
                                            <div class="card-body d-flex flex-column justify-content-between">
                                                <div>
                                                    <h6 class="card-title font-weight-bold text-primary">{{ $noticia->titulo }}</h6>
                                                    <p class="card-text text-muted">{{ $noticia->assunto }}</p>
                                                </div>
                                                <div>
                                                    <button type="button" class="btn btn-outline-success btn-sm action-button" data-modal-id="editModal-{{ $noticia->id }}" title="Editar notícia"><i class="fas fa-edit"></i></button>
                                                    <button type="button" class="btn btn-outline-danger btn-sm action-button" data-modal-id="deleteModal-{{ $noticia->id }}" title="Apagar notícia"><i class="fas fa-trash"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Editar Modal -->
                                    <div class="modal fade" id="editModal-{{ $noticia->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel">Edit notícia</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- form para editar a noticia -->
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal-{{ $noticia->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">Delete notícia</h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Tem a certeza que deseja apagar a notícia?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                                                    <button type="button" class="btn btn-danger">Sim, apagar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Carregar Crédito Modal -->
            <div class="modal fade" id="carregarModal" tabindex="-1" aria-labelledby="carregarModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="carregarModalLabel">Carregar Crédito</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('carregar') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="valor" class="form-label">Valor do Carregamento</label>
                                    <input type="number" class="form-control" id="valor" name="valor" min="10" max="1000.00"  required>

                                </div>
                                <div class="mb-3">
                                    <p class="text-muted">Carregue créditos para aproveitar ao máximo os nossos serviços. Adicione o valor desejado abaixo.</p>
                                </div>
                                <div class="mb-3">
                                    <p class="text-muted">Regras:</p>
                                    <ul class="text-muted">
                                        <li>Valor mínimo de carregamento: 10.00€</li>
                                        <li>Valor máximo de carregamento: 1000.00€</li>
                                        <li>O crédito carregado não é reembolsável.</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-outline-primary">Carregar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Editar Perfil Modal -->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Editar Perfil</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('perfil.update', auth()->id()) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="text-center">
                                    <img src="{{ Auth::user()->avatar }}" alt="Avatar" class="avatar img-fluid rounded-circle mb-3">
                                </div>
                                <div class="mb-3">
                                    <label for="telemovel" class="form-label">Telemóvel</label>
                                    <input type="text" class="form-control" id="telemovel" name="telemovel" value="{{ Auth::user()->telemovel }}">
                                </div>
                                <div class="mb-3">
                                    <label for="avatar" class="form-label">Avatar</label>
                                    <input type="file" class="form-control-file" id="avatar" name="avatar" value="{{ Auth::user()->avatar }}">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-outline-primary">Guardar Alterações</button>
                            </div>
                        </form>
                        <div class="modal-footer bg-light text-center">
                            <p class="mb-0">Edite o seu perfil adicionando um avatar e atualizando as suas informações.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Associar Perfil Modal -->
            <div class="modal fade" id="associarModal" tabindex="-1" aria-labelledby="associarModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="associarModalLabel">Torna-te um associado!</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="associarCampo" class="form-label">Para se tornar um associado, necessitará de pagar uma cota equivalente a {{$lastCota->valor}}€.</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button type="button" class="btn btn-primary" data-bs-target="#creditCardModal" data-bs-toggle="modal" data-bs-dismiss="modal">Associar</button>
                        </div>
                    </div>
                </div>
            </div>

        @include('menu.creditCard')
    </div>
    </div>
</body>

<script>
    $(document).ready(function() {
        @if(session()->has('success'))
        $('#successModal').modal('show');
        @elseif(session()->has('error'))
        $('#errorModal').modal('show');
        @endif
    });
</script>

<script>
    document.querySelectorAll('.action-button').forEach(function(button) {
        button.addEventListener('click', function() {
            var targetModalId = this.getAttribute('data-modal-id');
            console.log('Target modal ID:', targetModalId); // This will log the ID of the target modal

            var previousModal = document.getElementById('noticiasModal');
            var previousModalBootstrap = bootstrap.Modal.getInstance(previousModal);
            previousModalBootstrap.hide();

            var targetModalElement = document.getElementById(targetModalId);
            console.log('Target modal element:', targetModalElement); // This will log the HTML element of the target modal

            var targetModal = new bootstrap.Modal(targetModalElement, {
                focus: true
            });
            targetModal.show();
        });
    });
</script>



</html>
