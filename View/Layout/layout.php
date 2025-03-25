<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Paraíso Tico</title>
   
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="View/Styles/bootstrap.css" rel="stylesheet" />
    <link href="View/Styles/styles.css" rel="stylesheet" />
    <link href="View/Styles/blog.css" rel="stylesheet" />
    <link href="View/Styles/blogDetail.css" rel="stylesheet" />
    <link href="View/Styles/reservacion.css" rel="stylesheet" />
</head>
<body id="page-top">
    <!-- Incluir el nav -->
    <?php include 'View/Partials/nav.php'; ?>

    <!-- Incluir el header -->
    <?php include 'View/Partials/header.php'; ?>

    <!-- Contenido dinámico -->
    <?= $content ?>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>