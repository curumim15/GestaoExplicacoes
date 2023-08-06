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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


    <title>Escola Inclusiva - Página Inicial</title>
</head>

<body>

@include('menu.navbar')

<div class="container m-5">
    <div class="row">
        <div class="col-2">
            <h1>Explicações</h1>
        </div>
        <div class="col-6">
            <form action="{{ route('explicacoes.search') }}" method="get" class="mt-2 mb-3">
                <div class="input-group">
                    <input type="search" name="query" class="form-control rounded" placeholder="Procurar disciplina ou Professor" aria-label="Search"
                           aria-describedby="search-addon" />
                    <button class="btn btn-outline-secondary" type="submit" id="search-addon">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
        <div class="col-4 d-flex justify-content-end">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Filtros
                </button>
                <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                    <li><a class="dropdown-item" href="{{ route('explicacoes.search', ['query' => request()->query, 'sort' => 'price_asc']) }}">Preço mais baixo para mais alto</a></li>
                    <li><a class="dropdown-item" href="{{ route('explicacoes.search', ['query' => request()->query, 'sort' => 'price_desc']) }}">Preço mais alto para mais baixo</a></li>
                </ul>
            </div>
        </div>
    </div>


    <div class="row m-2">
            <!-- Aqui podes iterar sobre as explicações existentes para exibi-las -->
            @foreach ($explicacoes as $explicacao)
                <div class="col-3 mb-4 mt-4">
                    <div class="card border-0 shadow-lg p-3 mb-5 bg-light rounded text-center"
                         style="transition: transform 0.3s ease-in-out;">
                        <img src="{{ $explicacao->user->avatar }}" alt="Product"
                             class="card-img-top rounded-circle mx-auto d-block img-fixed">
                        <div class="card-body">
                            <h5 class="card-title mb-3">{{ $explicacao->user->name }}</h5>
                            <a href="#" style="text-decoration: none" data-bs-toggle="modal"
                               data-bs-target="#infoExplicacaoModal{{ $explicacao->id }}"
                               class="text-dark">{{ $explicacao->disciplina }}</a>
                            <p class="card-text">Preço: <strong>{{ $explicacao->preco }}€/h</strong></p>
                        </div>
                        <div class="card-footer bg-light border-top">
                            <div class="row justify-content-center">
                                @if (Auth::check() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('professor')) && Auth::user()->id == $explicacao->user_id)
                                    <div class="col-4">
                                        <a href="" class="btn btn-outline-success w-100" data-bs-toggle="modal"
                                           title="Editar Explicação"
                                           data-bs-target="#editarExplicacaoModal{{ $explicacao->id }}"><i
                                                class="fas fa-edit"></i></a>
                                    </div>
                                    <div class="col-4">
                                        <a href="" class="btn btn-outline-danger w-100" data-bs-toggle="modal"
                                           title="Apagar Explicação"
                                           data-bs-target="#excluirExplicacaoModal{{ $explicacao->id }}"><i
                                                class="fas fa-trash"></i></a>
                                    </div>
                                @endif
                                <div class="col-4">
                                    <a href="" class="btn btn-outline-primary w-100" data-bs-toggle="modal"
                                       title="Ver mais detalhes"
                                       data-bs-target="#infoExplicacaoModal{{ $explicacao->id }}"><i
                                            class="fas fa-eye"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <style>
                    .card:hover {
                        transform: scale(1.1);
                    }

                    .img-fixed {
                        width: 100px;
                        height: 100px;
                        object-fit: cover;
                    }
                </style>

                <!--Information Explanation Modal-->
                <div class="modal fade" id="infoExplicacaoModal{{ $explicacao->id }}" tabindex="-1"
                     aria-labelledby="infoExplicacaoModalLabel{{ $explicacao->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-dark" id="infoExplicacaoModalLabel{{ $explicacao->id }}">
                                    <i class="bi bi-info-circle-fill"></i> Informações da Explicação
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <h6 class="mb-2 text-secondary"><i class="bi bi-person-fill"></i> Nome do Professor:
                                    </h6>
                                    <p class="text-dark font-italic">{{ $explicacao->user->name }}</p>
                                </div>
                                <hr/>
                                <div class="mb-3">
                                    <h6 class="mb-2 text-secondary"><i class="bi bi-person-fill"></i> Telemóvel:
                                    </h6>
                                    <p class="text-dark font-italic">{{ $explicacao->user->telemovel }}</p>
                                </div>
                                <hr/>
                                <div class="mb-3">
                                    <h6 class="mb-2 text-secondary"><i class="bi bi-book-fill"></i> Disciplina:</h6>
                                    <p class="text-dark font-italic">{{ $explicacao->disciplina }}</p>
                                </div>
                                <hr/>
                                <div class="mb-3">
                                    <h6 class="mb-2 text-secondary"><i class="bi bi-cash-coin"></i> Preço:</h6>
                                    <p class="text-dark font-italic">{{ $explicacao->preco }}€/h</p>
                                </div>
                                <hr/>
                                <div class="mb-3">
                                    <h6 class="mb-2 text-secondary"><i class="bi bi-calendar3"></i> Disponibilidade:
                                    </h6>
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
                                    @foreach($disponibilidadesGrouped as $dia => $horas)
                                        <h6 class="text-dark font-italic">{{ $dayNames[$dia - 1] }}:</h6>
                                        @foreach($horas as $hora)
                                            <span class="badge bg-primary">{{ $hora }}</span>
                                        @endforeach
                                        <br>
                                    @endforeach
                                </div>
                                <hr/>
                                <div class="mb-3">
                                    <h6 class="mb-2 text-secondary"><i class="bi bi-journal-text"></i> Descrição:</h6>
                                    <p class="text-dark font-italic">{{ $explicacao->descricao }}</p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fechar
                                </button>
                                @if (Auth::check() && auth()->user()->hasRole('aluno'))
                                    <form action="{{ route('explicacoes.comprar', $explicacao->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-success">Comprar</button>
                                    </form>
                                @endif
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
                                            <form action="{{ route('explicacoes.updateMain', $explicacao->id) }}" method="POST">
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
                                <p>Você tem certeza de que deseja excluir esta explicação?</p>
                                <form action="{{ route('explicacoes.deleteMain', $explicacao->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Excluir</button>
                                </form>
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

        </div>

<script src="{{ asset('vendor/jquery/jquery.js') }}"></script>

@if (Auth::check() && (auth()->user()->hasRole('admin') || auth()->user()->hasRole('professor')))
    <div style="position:fixed; bottom:20px; right:20px;">
        <button type="button" class="btn btn-info m-3" data-bs-toggle="modal" data-bs-target="#criarExplicacaoModal"
                style="border-radius:50%; width:60px; height:60px;">
            <i class="fas fa-plus"></i>
        </button>
    </div>
@endif

<style>
    .btn-outline-info {
        border-color: #17a2b8;
        color: #17a2b8;
    }

    .btn-outline-info:hover {
        background-color: #17a2b8;
        color: #fff;
    }

    .card:hover {
        transform: scale(1.1);
    }

    .img-fixed {
        width: 100px;
        height: 100px;
        object-fit: cover;
    }
</style>

<!-- Modal para criar uma nova explicação -->
<div class="modal fade" id="criarExplicacaoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Criar Nova Explicação</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulário para criar a explicação -->
                <form action="{{ route('explicacoes.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="disciplina" class="form-label">Disciplina</label>
                        <input type="text" class="form-control" id="disciplina" name="disciplina" required>
                    </div>
                    <div class="mb-3">
                        <label for="max_alunos" class="form-label">Número Máximo de Alunos</label>
                        <input type="number" class="form-control" id="max_alunos" name="max_alunos" required>
                    </div>
                    <div class="mb-3" id="timeBlocks">
                        <label for="day_hour_1" class="form-label">Dia e Bloco de Horas</label>
                        <div class="input-group mb-3" id="day_hour_1">
                            <select class="form-select" name="days[]" required>
                                <option value="1">Domingo</option>
                                <option value="2">Segunda-Feira</option>
                                <option value="3">Terça-Feira</option>
                                <option value="4">Quarta-Feira</option>
                                <option value="5">Quinta-Feira</option>
                                <option value="6">Sexta-Feira</option>
                                <option value="7">Sábado</option>
                            </select>
                            <input type="time" class="form-control" name="hours[]" required>
                        </div>
                    </div>

                    <button type="button" class="btn btn-outline-success mb-3" id="addTimeBlock">Adicionar mais um dia
                    </button>

                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição</label>
                        <textarea class="form-control" id="descricao" name="descricao" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="preco" class="form-label">Preço por hora</label>
                        <input type="number" step="0.01" class="form-control" id="preco" name="preco" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Criar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let timeBlockId = 2;
    document.getElementById('addTimeBlock').addEventListener('click', function () {
        const timeBlock = document.createElement('div');
        timeBlock.classList.add('input-group', 'mb-3');
        timeBlock.id = 'day_hour_' + timeBlockId;

        timeBlock.innerHTML = `
           <select class="form-select" name="days[]" required>
                                <option value="1">Domingo</option>
                                <option value="2">Segunda-Feira</option>
                                <option value="3">Terça-Feira</option>
                                <option value="4">Quarta-Feira</option>
                                <option value="5">Quinta-Feira</option>
                                <option value="6">Sexta-Feira</option>
                                <option value="7">Sábado</option>
                            </select>
            <input type="time" class="form-control" name="hours[]" required>
            <button class="btn btn-outline-danger removeTimeBlock" type="button">Remover</button>
        `;

        document.getElementById('timeBlocks').appendChild(timeBlock);

        document.querySelectorAll('.removeTimeBlock').forEach(button => button.addEventListener('click', function (e) {
            e.target.parentNode.remove();
        }));

        timeBlockId++;
    });
</script>
<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function buyExplanation(explicacaoId, preco) {
        @if(Auth::check() && (auth()->user()->credito))
        // Verificar se o usuário tem créditos suficientes
        var userCredito = {{ auth()->user()->credito }};
        if (userCredito < preco) {
            // Exibir SweetAlert informando que não há créditos suficientes
            Swal.fire({
                icon: 'error',
                title: 'Créditos Insuficientes',
                text: 'Você não possui créditos suficientes para comprar esta explicação.',
                showConfirmButton: true
            });
        } else {
            // Efetuar a compra e deduzir os créditos da conta do usuário
            $.ajax({
                url: '{{ route('explicacoes.comprar', ['explicacao' => '__explicacaoId__']) }}'.replace('__explicacaoId__', explicacaoId),
                type: 'POST',
                data: {
                    explicacao_id: explicacaoId,
                    preco: preco,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    // Atualizar os créditos do usuário na página (opcional)
                    userCredito -= preco;
                    $('strong[title="Carregar Créditos"]').text(userCredito);

                    // Exibir mensagem de sucesso
                    Swal.fire({
                        icon: 'success',
                        title: 'Compra Realizada',
                        text: 'A compra foi realizada com sucesso.',
                        showConfirmButton: false,
                        timer: 2000
                    });
                },
                error: function () {
                    // Exibir mensagem de erro em caso de falha na compra
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro',
                        text: 'Ocorreu um erro ao processar a compra.',
                        showConfirmButton: true
                    });
                }
            });
        }
        @endif
    }
</script>
</body>
</html>
