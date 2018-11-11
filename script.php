<?php


class ImageGallery
{
    var $UserID;//
    public function __construct($UserID)
    {
        $this->UserID = $UserID;
    }


    public function SAVE($tmp, $orig_name)
    {
        $path = 'gallery/';
        //Проверить тип и размер файла

        // Загрузка файла
        if (!move_uploaded_file('' . $tmp, '' . $path . '' . $orig_name)) {
            echo 'Что-то пошло не так';
        } else {
            echo 'картинка успешно загружена <a href="gallery.php">Перетий в галерею</a> ';
        }

    }

    public function GetList()
    {
        //echo "tralala!";
    }

}


//// Пути загрузки файлов
//$path = 'gallery/';
//$tmp_path = 'tmp/';
//$types = array('image/gif', 'image/png', 'image/jpeg'); // Допустимый тип файла
////$size = 102400000; // Максимальный размер файла
//
////Обработка запроса
//if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//
//    // Проверяем тип файла
//    if (!in_array($_FILES['myfile']['type'], $types))
//        echo('Неверный тип файла. <a href="?">Попробовать другой файл?</a> Попробовать другой файл?');
//
//    // Проверяем размер файла
//    if ($_FILES['myfile']['size'] > $size)
//        echo('Недопустимый размер файла. <a href="?">Попробовать другой файл?</a>');
//
//    // Загрузка файла и вывод сообщения
//    if (!copy('' . $_FILES['myfile']['tmp_name'], '' . $path . '' . $_FILES['myfile']['name']))
//        echo 'Что-то пошло не так';
//    else
//        echo 'картинка успешно загружена <a href="gallery.php">Перетий в галерею</a> ';
//}
