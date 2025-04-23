<?php
    $jsonData = file_get_contents(__DIR__ . '/../View/Data/tours.json');
    $tours = json_decode($jsonData, true);
    
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    
    $tour = null;
    foreach ($tours as $item) {
        if ($item['id'] === $id) {
            $tour = $item;
            break;
        }
    }
    if (!$tour) {
        echo "Tour no encontrado.";
        exit;
    }
    
    $imageIndex = $tour['id'];
    $mainImagePath = "../Img/blog/image_blog_" . $imageIndex . ".jpg";
    
    $galleryCount = 30;
    $galleryImages = [];
    for ($i = 1; $i <= $galleryCount; $i++) {
        $extraIndex = (($tour['id'] + $i) % 30) + 1;
        $galleryImages[] = "../Img/blog/image_blog_" . $extraIndex . ".jpg";
    }
    $chunks = array_chunk($galleryImages, 3);
?>