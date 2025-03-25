<nav class="navbar navbar-expand-lg text-uppercase fixed-top" id="mainNav" style="background-color:rgb(68, 122, 158);">
    <div class="container">
        <a class="navbar-brand" href="index.php?route=home&action=home">Paraíso Tico</a>
        <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#portfolio">Destinos</a></li>
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="index.php?route=blog&action=blog">Blog</a></li>
                <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#contact">Contacto</a></li>
            </ul>
        </div>

        <div class="dropdown">
            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="avatar avatar-sm avatar-status avatar-status-success mr-3">
                    <!-- <img class="avatar-img" src="<?= $_SESSION['usuario']['ruta_imagen'] ?>" alt="..."> -->
                </span>
                <?= $_SESSION['usuario']['nombre'] ?? "Invitado" ?>
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="index.php?route=home&action=cuenta">Cuenta</a></li>
                <li><a class="dropdown-item" href="#">Cambiar Contraseña</a></li>
                <li><a class="dropdown-item" href="#">Administrar Actividades</a></li>
                <li><a class="dropdown-item" href="index.php?route=reservacion&action=reservar">Hacer Reservacion</a></li>
                <li><a class="dropdown-item" href="index.php?route=reservacion&action=index">Mis Reservaciones</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="index.php?route=login&action=logout">Cerrar Sesión</a></li>
            </ul>
        </div>
    </div>
</nav>