<?php

    if(session_status() == PHP_SESSION_NONE){
        session_start();
    }

    function printCSS(){
        echo '<head>
            <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
            <meta name="description" content="" />
            <meta name="author" content="" />
            <title>Paraíso Tico</title>
            <!-- Google fonts-->
            <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
            <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
            <!-- Core theme CSS (includes Bootstrap)-->
            <link href="../Styles/bootstrap.min.css" rel="stylesheet"/>
            <link href="../Styles/styles.css" rel="stylesheet" />            
        </head>';
    }

    function printScript() {
        echo ' <!-- Font Awesome icons (free version)-->
            <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
            <script src="../Scripts/jquery.min.js"></script>
            <script src="../Scripts/bootstrap.bundle.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
            ';
    }

    function barraNavegacion(){
        echo ' 
        <nav class="navbar navbar-expand-lg text-uppercase fixed-top" id="mainNav" style="background-color:rgb(68, 122, 158);">
            <div class="container">
                <a class="navbar-brand" href="../Login/home.php">Paraíso Tico</a>
                <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#portfolio">Destinos</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="blog.php">Blog</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="#contact">Contacto</a></li>
                    </ul>
                </div>

                <div class="dropdown ml-auto my-n2" >
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        <span class="avatar avatar-sm avatar-status avatar-status-success mr-3">
                            <img class="rounded-circle" src="../assets/img/photo-6.jpg" 
                                style="width: 40px; height: 40px; object-fit: cover;" alt="avatar"/>
                        </span>
                        UserName
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="#">Cuenta</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Cambiar Contraseña</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="../Categorias/listado.php">Administrar Actividades</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="../Login/login.php">Cerrar Sesión</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>';
    }

?>