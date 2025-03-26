<?php
// app/models/Usuario.php
require_once 'DataBaseSQLSetUp/Database.php';

class Usuario
{
    private static $conn;

    public $id_usuario;
    public $username;
    public $password;
    public $nombre;
    public $primer_apellido;
    public $correo;
    public $telefono;
    public $ruta_imagen;
    public $activo;

    public function __construct()
    {
        self::init();
    }

    public static function init()
    {
        if (self::$conn === null) {
            $database = new Database();
            self::$conn = $database->getConnection();
        }
    }

    public static function login($usernameOrEmail, $password)
    {
        self::init();

        // Buscar al usuario por username o correo
        $query = "SELECT * FROM Usuario WHERE username = :usernameOrEmail OR correo = :usernameOrEmail;";
        $stmt = self::$conn->prepare($query);
        $stmt->execute([':usernameOrEmail' => $usernameOrEmail]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        echo "Usuario encontrado: " . print_r($row, true) . "<br>"; // Depuración
        echo "Contraseña proporcionada: " . $password . "<br>"; // Depuración
        echo "Contraseña almacenada: " . $row['password'] . "<br>"; // Depuración
        // Verificar la contraseña
        if (password_verify($password, $row['pass'])) {
        // if ($password == $row['password']) {
            echo "Contraseña válida<br>"; // Depuración
            $item = new self();
            $item->id_usuario = $row['id_usuario'];
            $item->username = $row['username'];
            $item->nombre = $row['nombre'];
            $item->primer_apellido = $row['primer_apellido'];
            $item->correo = $row['correo'];
            $item->telefono = $row['telefono'];
            $item->ruta_imagen = $row['ruta_imagen'];
            $item->activo = $row['activo'];

            return $item;
        }
        else {
            echo "Contraseña inválida";
        }
    }

    return null;
}

    // GET DATA

    public static function all()
    {
        self::init();

        $query = "SELECT * FROM Usuario;";
        $stmt = self::$conn->prepare($query);
        $stmt->execute();

        $data = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $item = new self();
            $item->id_usuario = $row['id_usuario'];
            $item->username = $row['username'];
            $item->nombre = $row['nombre'];
            $item->primer_apellido = $row['primer_apellido'];
            $item->correo = $row['correo'];
            $item->telefono = $row['telefono'];
            $item->ruta_imagen = $row['ruta_imagen'];
            $item->activo = $row['activo'];

            $data[] = $item;
        }

        return $data;
    }

    public static function find($id)
    {
        self::init();

        $query = "SELECT * FROM Usuario WHERE id_usuario = :id LIMIT 1;";
        $stmt = self::$conn->prepare($query);
        $stmt->execute([':id' => $id]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $item = new Usuario();
            $item->id_usuario = $row['id_usuario'];
            $item->username = $row['username'];
            $item->nombre = $row['nombre'];
            $item->primer_apellido = $row['primer_apellido'];
            $item->correo = $row['correo'];
            $item->telefono = $row['telefono'];
            $item->ruta_imagen = $row['ruta_imagen'];
            $item->activo = $row['activo'];

            return $item;
        } else {
            return null;
        }
    }

    // ACTIONS

    public function save()
    {
        try {
             self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "INSERT INTO Usuario (username, pass, nombre, primer_apellido, correo, telefono, ruta_imagen, activo)
                  VALUES (:username, :pass, :nombre, :primer_apellido, :correo, :telefono, :ruta_imagen, :activo);";
        $stmt = self::$conn->prepare($query);

        $result = $stmt->execute([
            ':username' => $this->username,
            ':pass' => $this->password, // Cifrar la contraseña
            ':nombre' => $this->nombre,
            ':primer_apellido' => $this->primer_apellido,
            ':correo' => $this->correo,
            ':telefono' => $this->telefono,
            ':ruta_imagen' => $this->ruta_imagen,
            ':activo' => $this->activo,
        ]);

        return $result;
        } catch (PDOException $e) {
        error_log("Error al guardar el usuario: " . $e->getMessage());
        return false;
    }
    }

    public function update()
    {
        $query = "UPDATE Usuario SET
                  username = :username,
                  nombre = :nombre,
                  primer_apellido = :primer_apellido,
                  correo = :correo,
                  telefono = :telefono,
                  ruta_imagen = :ruta_imagen,
                  activo = :activo
                  WHERE id_usuario = :id;";
        $stmt = self::$conn->prepare($query);

        $result = $stmt->execute([
            ':id' => $this->id_usuario,
            ':username' => $this->username,
            ':nombre' => $this->nombre,
            ':primer_apellido' => $this->primer_apellido,
            ':correo' => $this->correo,
            ':telefono' => $this->telefono,
            ':ruta_imagen' => $this->ruta_imagen,
            ':activo' => $this->activo,
        ]);

        return $result;
    }

    public function delete()
    {
        $query = "DELETE FROM Usuario WHERE id_usuario = :id;";
        $stmt = self::$conn->prepare($query);

        $result = $stmt->execute([':id' => $this->id_usuario]);

        return $result;
    }

    public function updatePassword($currentPassword, $newPassword)
    {
    
        // Cargar la contraseña hasheada desde la BD antes de verificar
    $query = "SELECT pass FROM Usuario WHERE id_usuario = :id";
    $stmt = self::$conn->prepare($query);
    $stmt->execute([':id' => $this->id_usuario]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        return false; // Usuario no encontrado
    }

    $hashedPassword = $usuario['pass']; // Obtener el hash de la BD

    if (!password_verify($currentPassword, $hashedPassword)) {
        return false; // La contraseña actual no es correcta
    }

    // Hashear la nueva contraseña
    $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

    // Actualizar la contraseña en la BD
    $query = "UPDATE Usuario SET pass = :pass WHERE id_usuario = :id";
    $stmt = self::$conn->prepare($query);
    $result = $stmt->execute([
        ':pass' => $newHashedPassword,
        ':id' => $this->id_usuario,
    ]);

    return $result;
    }
}