<?php
    // Load and parse the JSON file containing tours
    $jsonData = file_get_contents(__DIR__ . '/../View/Data/tours.json');
    $tours = json_decode($jsonData, true);
?>