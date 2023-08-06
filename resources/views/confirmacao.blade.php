<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('js/navbar.js') }}">

    <link rel="icon" href="{{asset('images/IconEscolaInclusiva.png')}}">

    <!-- SweetAlert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.7/dist/sweetalert2.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.7/dist/sweetalert2.min.js"></script>


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <title>Confirmação de Registo</title>
</head>
<body>

@include('menu.navbar')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white text-center">
                    <h2>Confirmação de Registo</h2>
                </div>
                <div class="card-body">
                    <p class="card-text">Obrigado pelo seu registo! O seu pedido de conta foi enviado para análise do administrador.</p>
                    <div class="text-center">
                        <img style="max-width: 100px" src="/images/IconEscolaInclusiva.png" class="" alt="Check Image">
                    </div>
                </div>
                <div class="card-footer text-center">
                    <small class="text-muted">Muito obrigado por se juntar a nós!</small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
