<?php 
include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/Model/DBConexionModel.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/Model/UtilitariosController.php"; 
include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/Model/UsuarioModel.php"; 
session_start();  

// Registro de nuevo usuario
if (isset($_POST["btnCrearCuenta"])) {
    $correo = $_POST["email"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $contrasenna = $_POST["password"];
    $confirm_contrasenna = $_POST["confirm_password"];

    // Verificar si las contraseñas coinciden
    if ($contrasenna != $confirm_contrasenna) {
        $_SESSION["Message"] = "Las contraseñas no coinciden.";
        header('Location: ../View/Login/crearcuenta.php');
        exit();
    }

    // Verificar si el correo ya está registrado
    $resultado = VerificarCorreoExistente($correo);
    if ($resultado->num_rows > 0) {
        $_SESSION["Message"] = "El correo ya está registrado.";
        header('Location: ../View/Login/crearcuenta.php');
        exit();
    }

    // Registrar al nuevo usuario
    $resultado = RegistrarUsuario($correo, $nombre, $apellido, $contrasenna);
    if ($resultado) {
        $_SESSION["Message"] = "Cuenta creada con éxito. Inicia sesión.";
        header('Location: ../View/Login/login.php');
        exit();
    } else {
        $_SESSION["Message"] = "Error al crear cuenta, intenta nuevamente.";
        header('Location: ../View/Login/crearcuenta.php');
        exit();
    }
}

if(isset($_POST["btnSalir"]))
{
    session_destroy();
    header('location: ../../View/Login/login.php');
}

// Función para verificar si el correo ya existe en la base de datos
function VerificarCorreoExistente($correo) {
    $conexion = AbrirBaseDatos();
    $consulta = $conexion->prepare("SELECT * FROM usuario WHERE correo = ?");
    $consulta->bind_param("s", $correo);
    $consulta->execute();
    $resultado = $consulta->get_result();
    CerrarBaseDatos($conexion);
    return $resultado;
}

function RegistrarUsuario($correo, $nombre, $apellido, $contrasenna) {
    $username = explode('@', $correo)[0]; 

    $conexion = AbrirBaseDatos();
    $consulta = $conexion->prepare("INSERT INTO usuario (username, correo, nombre, primer_apellido, password, activo) VALUES (?, ?, ?, ?, ?, 1)");
    $consulta->bind_param("sssss", $username, $correo, $nombre, $apellido, $contrasenna);
    $resultado = $consulta->execute();
    CerrarBaseDatos($conexion);
    return $resultado;
}

// INICIO SESION EXISTENTE
if (isset($_POST["btnIniciarSesion"])) {
    $correo = $_POST["email"];  
    $contrasenna = $_POST["password"];  

    $resultado = IniciarSesionModel($correo);

    if ($resultado != null && $resultado->num_rows > 0) {
        $datos = mysqli_fetch_assoc($resultado);

        // Comparar contraseñas en texto plano
        if ($contrasenna == $datos["password"]) {
            $_SESSION["IdUsuario"] = $datos["id_usuario"];
            $_SESSION["CorreoUsuario"] = $datos["correo"];
            $_SESSION["NombreUsuario"] = $datos["nombre"] . " " . $datos["primer_apellido"]; 
            $_SESSION["RolUsuario"] = $datos["rol"]; 

            header('Location: ../View/Login/home.php');
            exit();
        } else {
            $_SESSION["Message"] = "Correo o contraseña incorrectos.";
            header('Location: ../View/Login/login.php');
            exit();
        }
    } else {
        $_SESSION["Message"] = "Correo o contraseña incorrectos.";
        header('Location: ../View/Login/login.php');
        exit();
    }
}

function IniciarSesionModel($correo) {
    $conexion = AbrirBaseDatos();  

    $consulta = $conexion->prepare("SELECT id_usuario, password, nombre, primer_apellido, correo, rol FROM usuario WHERE correo = ?");
    $consulta->bind_param("s", $correo);
    $consulta->execute();
    $resultado = $consulta->get_result();

    CerrarBaseDatos($conexion);  
    return $resultado;
}

if(isset($_POST["btnRecuperarCuenta"])) {
    $correo = $_POST["txtCorreo"];
    $resultado = ValidarUsuarioCorreoModel($correo);

    if($resultado != null && $resultado->num_rows > 0) {
        $datos = mysqli_fetch_assoc($resultado);
        $codigo = GenerarCodigo();

        if(RecuperarContrasennaModel($datos["Id"], $codigo)) {
            $contenido = "<html><body>
            Estimado(a) " . $datos["NombreUsuario"] . "<br/><br/>
            Se ha generado el siguiente código de seguridad: <b>" . $codigo . "</b><br/>
            Recuerde realizar el cambio de contraseña una vez que ingrese al sistema.</body></html>";

            if(EnviarCorreo("Recuperar Contraseña", $contenido, $datos["Correo"])) {
                $_SESSION["Message"] = "Se ha enviado un código de recuperación a su correo.";
            } else {
                $_SESSION["Message"] = "Error al enviar el correo. Por favor intente más tarde.";
            }
        } else {
            $_SESSION["Message"] = "Error al generar código de recuperación.";
        }
    } else {
        $_SESSION["Message"] = "El correo no está registrado en nuestro sistema.";
    }
    header('Location: ../View/Login/login.php');
    exit();
}

function GenerarCodigo() {
    $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $pass = array();
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 0; $i < 6; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass);
}

