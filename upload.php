
<?php
require_once 'classes/ImageManager.php';

header('Content-Type: application/json');

$response = ['success' => false, 'message' => 'Неверный запрос'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $manager = new ImageManager();
    $response = $manager->upload($_FILES['image']);
} else {
    $response['message'] = 'Файл не передан';
}

echo json_encode($response);
