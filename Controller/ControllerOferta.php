<?php
// app/controllers/OfertaController.php
require_once 'Model/Oferta.php';

class OfertaController
{
    public function index()
    {
        $ofertas = Oferta::all();
        require_once '../view/oferta/index.php';
    }

    public function active()
    {
        $ofertas = Oferta::getActiveOffers();
        require_once '../view/oferta/index.php';
    }

    public function show($id)
    {
        $oferta = Oferta::find($id);
        if ($oferta) {
            require_once '../view/oferta/show.php';
        } else {
            header('Location: /ofertas');
        }
    }

    public function create()
    {
        require_once '../view/oferta/create.php';
    }

    public function store()
    {
        $oferta = new Oferta();
        $oferta->descripcion = $_POST['descripcion'];
        $oferta->descuento = $_POST['descuento'];
        $oferta->fecha_publicacion = $_POST['fecha_publicacion'];
        $oferta->fecha_inicio = $_POST['fecha_inicio'];
        $oferta->fecha_fin = $_POST['fecha_fin'];
        
        if ($oferta->save()) {
            header('Location: /ofertas');
        } else {
            // Manejar error
            require_once '../view/oferta/create.php';
        }
    }

    public function edit($id)
    {
        $oferta = Oferta::find($id);
        if ($oferta) {
            require_once '../view/oferta/edit.php';
        } else {
            header('Location: /ofertas');
        }
    }

    public function update($id)
    {
        $oferta = Oferta::find($id);
        if ($oferta) {
            $oferta->descripcion = $_POST['descripcion'];
            $oferta->descuento = $_POST['descuento'];
            $oferta->fecha_publicacion = $_POST['fecha_publicacion'];
            $oferta->fecha_inicio = $_POST['fecha_inicio'];
            $oferta->fecha_fin = $_POST['fecha_fin'];
            $oferta->activo = $_POST['activo'] ?? 0;

            if ($oferta->update()) {
                header('Location: /ofertas/' . $id);
            } else {
                // Manejar error
                require_once '../view/oferta/edit.php';
            }
        } else {
            header('Location: /ofertas');
        }
    }

    public function destroy($id)
    {
        $oferta = Oferta::find($id);
        if ($oferta && $oferta->delete()) {
            header('Location: /ofertas');
        } else {
            // Manejar error
            header('Location: /ofertas/' . $id);
        }
    }
}