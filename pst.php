<?php include 'script.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $tmp = $_FILES['myfile']['tmp_name'];
    $orig_name = $_FILES['myfile']['name'];

    $file = new ImageGallery(123);
    $file->SAVE($tmp, $orig_name);
}


