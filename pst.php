<?php include 'script.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $sourcePath = $_FILES['myfile']['tmp_name'];
    $originalName = $_FILES['myfile']['name'];
    $fileType = $_FILES['myfile']['type'];

    try {
        $file = new ImageGallery(123);
        $file->Save($sourcePath, $fileType, $originalName);
    } catch (Exception $e) {
        die($e->getMessage());
    }

}