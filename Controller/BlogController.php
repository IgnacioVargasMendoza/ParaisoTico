<?php
// require_once __DIR__ . '/../Model/Blog.php';
require_once 'Model/Blog.php';

class BlogController
{
    private $model;

    public function __construct()
    {
        $this->model = new Blog();
    }

    public function blog()
    {
        // Obtener los tours desde el modelo
        $tours = $this->model->getTours();

        // Verificar si hay tours
            if (empty($tours)) {
                error_log("No se encontraron tours en el archivo JSON.");
            }
        // Obtener las rutas de las imágenes
        $totalImages = 30;
        foreach ($tours as $index => &$tour) {
            $imageIndex = ($index % $totalImages) + 1;
            $tour['imagePath'] = $this->model->getImagePath($imageIndex);
            // echo "Ruta de la imagen para el tour {$tour['id']}: " . $tour['imagePath'] . "<br>";
        }

            include 'View/Login/blog.php';
    }

    public function blogDetail($id)
    {
        // Obtener los tours desde el modelo
        $tours = $this->model->getTours();

        // Buscar el tour con el ID proporcionado
        $selectedTour = null;
        foreach ($tours as $tour) {
            if ($tour['id'] == $id) {
                $selectedTour = $tour;
                break;
            }
        }

        if (!$selectedTour) {
            echo "No se encontró el tour con el ID proporcionado.";
            exit;
        }

        // Obtener la ruta de la imagen principal
        $mainImagePath = 'View/Img/blog/image_blog_' . $selectedTour['id'] . '.jpg';

        // Obtener las rutas de las imágenes de la galería
        $totalImages = 30;
        $galleryImages = [];
        for ($i = 1; $i <= $totalImages; $i++) {
            $imagePath = 'View/Img/blog/image_blog_' . $i . '.jpg';
            if (file_exists(__DIR__ . '/../../' . $imagePath)) {
                $galleryImages[] = $imagePath;
            }
        }

        // Dividir las imágenes en grupos de 3 para el carrusel
        $chunks = array_chunk($galleryImages, 3);

        // Pasar los datos a la vista
        include 'View/Login/blogDetail.php';
    }
    
}
?>