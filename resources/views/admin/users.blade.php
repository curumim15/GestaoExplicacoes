<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../domain.png">

    <title>Clientes - Admin Dashboard</title>

    <!-- Custom fonts for this template-->
    <!-- Custom fonts for this template-->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="https://static.pingendo.com/bootstrap/bootstrap-4.3.1.css">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
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

                <!-- End of Topbar -->
                <h1 class="text-center">Lista de Utilizadores</h1>

                <div class="p-3">
                    <div class="row ml-2">
                        @foreach($users as $user)
                            <div class="col-xl-2 col-md-6 mb-4 d-inline-block">
                                <div class="card profile-card-3">
                                    <div class="background-block" style="background-color: #8D8D8D">
                                    </div>
                                    <div class="profile-thumb-block">
                                        <img src="{{ $user->avatar }}" alt="profile-image" class="profile"/>
                                    </div>
                                    <div class="card-content">
                                        <h5>{{ $user->name }}</h5>
                                        <p>{{ $user->role->nome }}</p>
                                        <div class="icon-block">
                                            <a class="" data-bs-toggle="modal"  style="cursor: pointer" data-bs-target="#verUtilizador-{{ $user->id }}"><i class="fa-solid fa-eye"></i></a>
                                            <a class="" data-bs-toggle="modal" style="cursor: pointer"  data-bs-target="#deactivateUser-{{ $user->id }}"><i class="fa-solid fa-trash"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="modal fade" id="verUtilizador-{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Perfil do Usuário - {{$user->name}}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar">Fechar</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <img src="{{$user->avatar}}" class="img-thumbnail">
                                                    </div>
                                                    <div class="col-8">
                                                        <h5>Informações Básicas</h5>
                                                        <p><strong>Nome:</strong> {{$user->name}}</p>
                                                        <p><strong>Email:</strong> {{$user->email}}</p>
                                                        <p><strong>Telefone:</strong> {{$user->telemovel}}</p>
                                                        <!-- Resto das informações básicas -->

                                                        <h5 class="mt-3">Informações Adicionais</h5>
                                                        <p><strong>Data de Nascimento:</strong> {{$user->dataNascimento}}</p>
                                                        <p><strong>Crédito:</strong> {{$user->credito}}</p>
                                                        <!-- Resto das informações adicionais -->
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <h5>Detalhes da Conta</h5>
                                                        <p><strong>Conta criada em:</strong> {{$user->created_at}}</p>
                                                        <p><strong>Última atualização:</strong> {{$user->updated_at}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Modal para desativar o utilizador -->
                            <div class="modal fade" id="deactivateUser-{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Desativar Utilizador</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar">Fechar</button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Tem certeza que deseja desativar o utilizador <strong>{{ $user->name }}</strong>?</p>
                                            <p class="mb-2">Email: <strong>{{ $user->email }}</strong></p>
                                            <p>Esta ação não pode ser desfeita e o utilizador será incapaz de aceder à sua conta.</p>
                                            <form action="{{ route('admin.users.deactivate', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger mt-3">Desativar</button>
                                            </form>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>

