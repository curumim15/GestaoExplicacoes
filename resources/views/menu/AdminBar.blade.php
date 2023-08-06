<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('explicacoes') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fa-solid fa-book"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin Dashboard</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Gerir
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.users.list') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Utilizadores</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.noticias.list') }}">
            <i class="fas fa-fw fa-globe"></i>
            <span>Notícias</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.associados.list') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Associados</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

</ul>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- End of Sidebar -->
