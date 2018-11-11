<?php

// Пути загрузки файлов
$path = './gallery/';
$tmp_path = 'tmp/';
$types = array('image/gif', 'image/png', 'image/jpeg'); // Допустимый тип файла
$size = 10240000; // Максимальный размер файла

//Обработка запроса
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo json_encode("post");

    // Проверяем тип файла
    if (!in_array($_FILES['picture']['type'], $types))
        die('Неверный тип файла. <a href="?">Попробовать другой файл?</a>');

    // Проверяем размер файла
    if ($_FILES['picture']['size'] > $size)
        die('Недопустимый размер файла. <a href="?">Попробовать другой файл?</a>');

    // Загрузка файла и вывод сообщения
    if (copy($_FILES['picture']['tmp_name'], '/gallery/me.jpg')) {
        echo 'Что-то пошло не так';
    } else {
        echo 'картинка успешно загружена <a href="gallery.php">Перетий в галерею</a> ';
    }

}
