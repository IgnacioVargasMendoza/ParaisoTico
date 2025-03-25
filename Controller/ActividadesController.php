<?php
// app/controllers/ActividadController.php
require_once 'Model/Actividad.php';

class ActividadController
{
    public function index()
    {
        $actividades = Actividad::all();
        require_once 'view/actividad/index.php';
    }

    public function show($id)
    {
        $actividad = Actividad::find($id);
        if ($actividad) {
            require_once 'view/actividad/show.php';
        } else {
            header('Location: /actividades');
        }
    }

    public function create()
    {
        require_once '../view/actividades/create.php';
    }

    public function store()
    {
        $actividad = new Actividad();
        $actividad->nombre = $_POST['nombre'];
        $actividad->descripcion = $_POST['descripcion'];
        $actividad->precio = $_POST['precio'];
        $actividad->punto_encuentro = $_POST['punto_encuentro'];
        $actividad->descripcion_incluye = $_POST['descripcion_incluye'];
        $actividad->id_categorias = $_POST['id_categorias'];
        $actividad->id_canton = $_POST['id_canton'];
        $actividad->foto = $_POST['foto'];
        
        if ($actividad->save()) {
            header('Location: /actividades');
        } else {
            // Manejar error
            require_once '../view/actividades/create.php';
        }
    }

    public function edit($id)
    {
        $actividad = Actividad::find($id);
        if ($actividad) {
            require_once '../views/actividad/edit.php';
        } else {
            header('Location: /actividades');
        }
    }

    public function update($id)
    {
        $actividad = Actividad::find($id);
        if ($actividad) {
            $actividad->nombre = $_POST['nombre'];
            $actividad->descripcion = $_POST['descripcion'];
            $actividad->precio = $_POST['precio'];
            $actividad->punto_encuentro = $_POST['punto_encuentro'];
            $actividad->descripcion_incluye = $_POST['descripcion_incluye'];
            $actividad->id_categorias = $_POST['id_categorias'];
            $actividad->id_canton = $_POST['id_canton'];
            $actividad->foto = $_POST['foto'];
            $actividad->activo = $_POST['activo'] ?? 0;

            if ($actividad->update()) {
                header('Location: /actividades/' . $id);
            } else {
                // Manejar error
                require_once '../view/actividad/edit.php';
            }
        } else {
            header('Location: /actividades');
        }
    }

    public function destroy($id)
    {
        $actividad = Actividad::find($id);
        if ($actividad && $actividad->delete()) {
            header('Location: /actividades');
        } else {
            // Manejar error
            header('Location: /actividades/' . $id);
        }
    }

    public function byCanton($id_canton)
    {
        $actividades = Actividad::getByCanton($id_canton);
        require_once 'view/actividad/index.php';
    }

    public function byCategoria($id_categoria)
    {
        $actividades = Actividad::getByCategoria($id_categoria);
        require_once 'view/actividades/index.php';
    }
}