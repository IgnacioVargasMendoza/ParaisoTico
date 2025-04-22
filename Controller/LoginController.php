<?php 
include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/Model/DBConexionModel.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/Model/UtilitariosController.php"; 
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

// RECUPERAR CONTRASEÑA
if (isset($_POST["btnRecuperarCuenta"])) {
    $correo = $_POST["txtCorreo"];

    // Verificar si el correo está registrado
    $resultado = VerificarCorreoExistente($correo);
    if ($resultado->num_rows > 0) {
        // Generar un token único
        $token = bin2hex(random_bytes(50));
        
        // Guardar el token en la base de datos
        $conexion = AbrirBaseDatos();
        $consulta = $conexion->prepare("UPDATE usuario SET token = ? WHERE correo = ?");
        $consulta->bind_param("ss", $token, $correo);
        $consulta->execute();
        CerrarBaseDatos($conexion);
        
        // Enviar el correo con el enlace para restablecer la contraseña
        $asunto = "Restablecer tu contraseña";
        $contenido = "<p>Haz clic en el siguiente enlace para restablecer tu contraseña:</p>";
        $contenido .= "<a href='http://localhost/ParaisoTico/View/Login/restablecerContra.php?token=" . $token . "'>Restablecer Contraseña</a>";
        
        // Llamamos a la función para enviar el correo
        if (EnviarCorreo($asunto, $contenido, $correo)) {
            $_SESSION["Message"] = "Te hemos enviado un enlace para restablecer tu contraseña.";
        } else {
            $_SESSION["Message"] = "Hubo un error al enviar el correo. Inténtalo nuevamente.";
        }
    } else {
        $_SESSION["Message"] = "El correo no está registrado en nuestros sistemas.";
    }

    header('Location: ../View/Login/cambiarcontra.php');  // Redirige al formulario de recuperación
    exit();
}
?>
