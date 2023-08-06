<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../domain.png">

    <title>Noticias - Admin Dashboard</title>

    <!-- Custom fonts for this template-->
    <!-- Custom fonts for this template-->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <!-- JavaScript do Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="{{ asset('css/sb-admin-2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <script src="https://kit.fontawesome.com/ccf24ce75c.js" crossorigin="anonymous"></script>

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    @include('menu.AdminBar')

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            @include('menu.topBar')


            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card m-3">
                                <div class="card-body p-0" style="max-height: 600px; overflow-y: scroll;">

                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Título</th>
                                            <th>Descrição</th>
                                            <th>Data Criação</th>
                                            <th>Criado Por</th>
                                            <th>Ações</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($noticias as $noticia)
                                            <tr>
                                                <td class="text-nowrap align-middle">
                                                    {{ Str::limit($noticia->titulo, 30) }}
                                                </td>
                                                <td class="text-nowrap align-middle">
                                                    {!! Str::limit($noticia->descricao, 30) !!}
                                                </td>
                                                <td class="text-nowrap align-middle"><span>{{ date('d/m/Y',strtotime($noticia->created_at)) }}</span></td>
                                                <td class="text-nowrap align-middle">{{ $noticia->user->name }}</td>
                                                <td class="text-center align-middle">
                                                    <div class="d-flex justify-content-around">
                                                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#verNoticiaModal{{ $noticia->id }}">Ver</button>
                                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editarNoticiaModal{{ $noticia->id }}">Editar</button>
                                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#apagarNoticiaModal{{ $noticia->id }}">Apagar</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>

                            <!-- Modal para ver notícia -->
                            @foreach ($noticias as $noticia)
                            <div class="modal fade" id="verNoticiaModal{{ $noticia->id }}" tabindex="-1" role="dialog" aria-labelledby="verNoticiaModalLabel{{ $noticia->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="verNoticiaModalLabel{{ $noticia->id }}">Ver Notícia</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Conteúdo da notícia -->
                                            <h3>{{ $noticia->titulo }}</h3>
                                            <p>{{ $noticia->descricao }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            <!-- Modal para editar notícia -->
                            @foreach ($noticias as $noticia)
                            <div class="modal fade" id="editarNoticiaModal{{ $noticia->id }}" tabindex="-1" role="dialog" aria-labelledby="editarNoticiaModalLabel{{ $noticia->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editarNoticiaModalLabel{{ $noticia->id }}">Editar Notícia</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Formulário para editar a notícia -->
                                            <!-- Exemplo de input para editar o título -->
                                            <div class="form-group">
                                                <label for="titulo">Título</label>
                                                <input type="text" class="form-control" id="titulo" name="titulo" value="{{ $noticia->titulo }}">
                                            </div>
                                            <!-- Exemplo de textarea para editar a descrição -->
                                            <div class="form-group">
                                                <label for="descricao">Descrição</label>
                                                <textarea class="form-control" id="descricao" name="descricao" rows="3">{{ $noticia->descricao }}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <button type="button" class="btn btn-primary">Salvar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            <!-- Modal para apagar notícia -->
                            @foreach ($noticias as $noticia)
                            <div class="modal fade" id="apagarNoticiaModal{{ $noticia->id }}" tabindex="-1" role="dialog" aria-labelledby="apagarNoticiaModalLabel{{ $noticia->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="apagarNoticiaModalLabel{{ $noticia->id }}">Apagar Notícia</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Deseja realmente apagar esta notícia?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <button type="button" class="btn btn-danger">Apagar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>

                </div><!-- /.container-fluid -->
            </div>

        </div>


    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<script>
    $(document).ready(function() {
        // Ação para o botão de editar notícia
        $('.btn-warning').click(function() {
            // Obter o ID da notícia a partir do atributo data-target do botão
            var noticiaId = $(this).data('target').replace('#editarNoticiaModal', '');
            // Aqui você pode fazer alguma ação, por exemplo, obter os dados da notícia pelo ID via AJAX e preencher o formulário de edição

            // Após obter os dados da notícia, você pode preencher o formulário de edição e abrir o modal
            // Exemplo:
            // $('#editarNoticiaModal' + noticiaId).find('#titulo').val('Novo título');
            // $('#editarNoticiaModal' + noticiaId).find('#descricao').val('Nova descrição');
            // $('#editarNoticiaModal' + noticiaId).modal('show');
        });

        // Ação para o botão de apagar notícia
        $('.btn-danger').click(function() {
            // Obter o ID da notícia a partir do atributo data-target do botão
            var noticiaId = $(this).data('target').replace('#apagarNoticiaModal', '');
            // Aqui você pode fazer alguma ação, por exemplo, enviar uma requisição para apagar a notícia via AJAX

            // Após apagar a notícia com sucesso, você pode atualizar a tabela de notícias (opcional) ou fazer outras ações necessárias
        });
    });
</script>

</body>

</html>

