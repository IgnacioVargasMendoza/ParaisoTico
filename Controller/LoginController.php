<?php 
include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/Model/DBConexionModel.php";
include_once $_SERVER["DOCUMENT_ROOT"] . "/ParaisoTico/Model/UtilitariosController.php"; 
session_start();  

class LoginController
{
public function login()
    {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usernameOrEmail = $_POST['email']; 
            $password = $_POST['password'];
            echo "Usuario/Email proporcionado: " . $usernameOrEmail . "<br>"; // Depuración
            echo "Contraseña proporcionada: " . $password . "<br>"; // Depuración


            // Validar las credenciales
            $usuario = Usuario::login($usernameOrEmail, $password);
            print_r($usuario, true);
            echo "Usuario: " . $usernameOrEmail;    
            echo "Contraseña: " . $password;    
            if ($usuario) {
                session_set_cookie_params(3600);
                // Iniciar sesión
                session_start();
                $_SESSION['usuario'] = [
                    'id_usuario' => $usuario->id_usuario,
                    'username' => $usuario->username,
                    'nombre' => $usuario->nombre,
                    'correo' => $usuario->correo,
                    'ruta_imagen' => $usuario->ruta_imagen,
                ];

                // Redirigir al home
                header('Location: index.php?route=home&action=home');
                exit();
            } else {
                // Mostrar mensaje de error
                session_start();
                $_SESSION['Message'] = "Credenciales incorrectas. Inténtalo de nuevo.";
                
                header('Location: index.php?route=login');
                exit();
            }
        }
    }

    public function register()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtener los datos del formulario
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $nombre = $_POST['nombre'] ?? '';
        $primer_apellido = $_POST['apellido'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';
        $imagen = $_FILES['imagen'] ?? null;

        // echo "Datos del formulario:<br>";
        // echo "Username: $username<br>";
        // echo "Email: $email<br>";
        // echo "Nombre: $nombre<br>";
        // echo "Apellido: $primer_apellido<br>";
        // echo "Password: $password<br>";
        // echo "Confirm Password: $confirm_password<br>";
        // echo "Imagen: " . print_r($imagen, true) . "<br>";

        // Validar que las contraseñas coincidan
        if ($password !== $confirm_password) {
            $_SESSION['Message'] = "Las contraseñas no coinciden.";
            header('Location: index.php?route=login&action=register');
            exit();
        }

        // Procesar la imagen
        if ($imagen && $imagen['error'] === UPLOAD_ERR_OK) {
            $rutaImagen = $this->guardarImagen($imagen);
            if (!$rutaImagen) {
                $_SESSION['Message'] = "Error al subir la imagen.";
                header('Location: index.php?route=login&action=register');
                exit();
            }
        } else {
            $_SESSION['Message'] = "Debes subir una imagen de perfil.";
            header('Location: index.php?route=login&action=register');
            exit();
        }

        // Crear un nuevo usuario
        $usuario = new Usuario();
        $usuario->username = $username;
        $usuario->correo = $email;
        $usuario->nombre = $nombre;
        $usuario->primer_apellido = $primer_apellido;
        $usuario->password = password_hash($password, PASSWORD_BCRYPT); 
        $usuario->ruta_imagen = $rutaImagen; 
        $usuario->activo = true; 

        // Guardar el usuario en la base de datos
        if ($usuario->save()) {
            $_SESSION['Message'] = "Usuario registrado correctamente. Inicia sesión.";
            header('Location: index.php?route=login');
            exit();
        } else {
            $_SESSION['Message'] = "Error al registrar el usuario.";
            header('Location: index.php?route=login&action=register');
            exit();
        }
    }
}

private function guardarImagen($imagen)
{
    $directorio = 'View/Img/usuarios/'; // Directorio donde se guardarán las imágenes
    if (!is_dir($directorio)) {
        mkdir($directorio, 0755, true); // Crear el directorio si no existe
    }

    $nombreArchivo = uniqid() . '_' . basename($imagen['name']); // Nombre único para evitar colisiones
    $rutaCompleta = $directorio . $nombreArchivo;

    if (move_uploaded_file($imagen['tmp_name'], $rutaCompleta)) {
        return $rutaCompleta; // Retornar la ruta relativa de la imagen
    } else {
        return false; // Error al mover el archivo
    }
}

    public function logout()
    {
        // Cerrar sesión
        session_start();
        session_unset();
        session_destroy();

        // Redirigir al login
        header('Location: index.php?route=login');
        exit();
    }
}
?>

