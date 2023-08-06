<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../domain.png">

    <title>Home - Admin Dashboard</title>

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

            <div class="row ml-2">

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Número de Utilizadores Registados</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $userCount }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Número de Associados Registados</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $associadosCount }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-user fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Receita Total</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"> €</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                -->

            </div>

            <div class="row ml-2">
                <!-- DONUT CHART -->
                <div class="col-xl-12 col-lg-5">
                    <div class="card shadow mb-4 mr-3">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Contas por aprovar:</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="mt-4">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Ações</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach ($users as $user)
                                        @if ($user->estado === 0)
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    <form action="{{ route('admin.users.approve', $user->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success">Aprovar</button>
                                                    </form>
                                                    <form action="{{ route('admin.users.reject', $user->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Rejeitar</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row ml-2">
                <!-- DONUT CHART -->
                <div class="col-xl-12 col-lg-5">
                    <div class="card shadow mb-4 mr-3">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Créditos por aprovar:</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="mt-4">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>Valor</th>
                                        <th>Ações</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($carregamentos as $carregamento)
                                        @if ($carregamento->estado === 'pendente')
                                            <tr>
                                                <td>{{ $carregamento->user->name }}</td>
                                                <td>{{ $carregamento->user->email }}</td>
                                                <td>{{ $carregamento->valor}}</td>
                                                <td>
                                                    <form action="{{ route('admin.carregamento.approve', $carregamento->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success">Aprovar</button>
                                                    </form>
                                                    <form action="{{ route('admin.carregamento.remove', $carregamento->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Rejeitar</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <div class="row ml-2">
            <div class="col-xl-12 col-lg-5">
                <div class="card shadow mb-4 mr-3">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Associados por aprovar:</h6>
                    </div>
                    <div class="card-body">
                        <div class="mt-4">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($users as $user)
                                    @if ($user->associado === 1)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <form action="{{ route('admin.associado.approve', $user->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success">Aprovar</button>
                                                </form>
                                                <form action="{{ route('admin.associado.remove', $user->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">Rejeitar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
</body>
</html>
