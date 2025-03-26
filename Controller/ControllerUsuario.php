<?php
// app/controllers/ControllerUsuarios.php
require_once 'Model/Usuario.php';

class ControllerUsuario
{
    // VIEWS

    public function index()
    {
        $data = Usuario::all();
        include 'view/home.php';
    }

    public function create()
    {
        include 'view/modules/usuarios/create.php';
    }
    
    public function changePassword()
    {
        include 'View/Usuario/changePassword.php';
    }

    public function edit($id)
    {
        $usuario = Usuario::find($id);
        include 'View/Usuario/edit.php';
    }

    public function show($id)
    {
        $item = Usuario::find($id);
        include 'app/view/modules/usuarios/show.php';
    }

    // ACTIONS

    public function store($request)
    {
        $item = new Usuario();

        $item->username = $request['username'];
        $item->password = $request['password'];
        $item->nombre = $request['nombre'];
        $item->primer_apellido = $request['primer_apellido'];
        $item->correo = $request['correo'];
        $item->telefono = $request['telefono'];
        $item->ruta_imagen = $request['ruta_imagen'];
        $item->activo = $request['activo'];

        $item->save();

        $this->go_home();
    }

    public function update($request, $id)
{
    $item = Usuario::find($id);

    // Actualizar los campos del usuario
    $item->username = $request['username'];
    $item->nombre = $request['nombre'];
    $item->primer_apellido = $request['primer_apellido'];
    $item->correo = $request['correo'];
    $item->telefono = $request['telefono'];

    // Manejar la subida de la imagen
    if (!empty($_FILES['ruta_imagen']['name'])) {
        $targetDir = "app/Views/Img/usuarios/";
        $targetFile = $targetDir . basename($_FILES['ruta_imagen']['name']);
        if (move_uploaded_file($_FILES['ruta_imagen']['tmp_name'], $targetFile)) {
            $item->ruta_imagen = $targetFile;
        }
    }

    $item->update();

    // Actualizar la sesión con los nuevos datos
    $_SESSION['usuario'] = [
        'id_usuario' => $item->id_usuario,
        'username' => $item->username,
        'nombre' => $item->nombre,
        'primer_apellido' => $item->primer_apellido,
        'correo' => $item->correo,
        'telefono' => $item->telefono,
        'ruta_imagen' => $item->ruta_imagen,
    ];

    // Redirigir a la vista de la cuenta
    header('Location: index.php?route=home&action=cuenta');
}

    public function destroy($id)
    {
        $item = Usuario::find($id);
        $item->delete();
        $this->go_home();
    }

    public function updatePassword($request, $id)
{
    
    $usuario = Usuario::find($id);

    if (!$usuario) {
        echo "No se encontró el usuario con el ID proporcionado.";
        exit;
    }

    
    $currentPassword = $request['current_password'];
    $newPassword = $request['new_password'];
    $confirmPassword = $request['confirm_password'];

    
    if ($newPassword !== $confirmPassword) {
        echo "Las nuevas contraseñas no coinciden.";
        exit;
    }

    
    if ($usuario->updatePassword($currentPassword, $newPassword)) {
        
        session_destroy(); 
        header('Location: index.php?route=login&action=login');
        exit;
    } else {
        echo "La contraseña actual es incorrecta.\n";
        // echo "\nLa currentPassword. \n".$currentPassword;
        // echo "\nLa newPassword. \n".$newPassword;
        // echo "La confirmPassword. ".$confirmPassword;
        exit;
    }
}
}