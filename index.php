<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script type="text/javascript">
        // $(function () {
        //     $('#form').submit(function (e) {
        //         e.preventDefault();
        //         var data = $(this).serialize();
        //         $.ajax({
        //             type: "POST",
        //             url: "index.php",
        //             data: data,
        //             success: function (result) {
        //                 $('#result').html(result);
        //             }
        //         });
        //     });
    </script>
    <title>Document</title>
</head>
<body>
<form method="post" enctype="multipart/form-data" id="form">
    <input type="file" name="picture">
    <input type="submit" value="Загрузить">
</form>
<div id="result">

</div>
<?php
// Пути загрузки файлов
$path = './gallery/';
$tmp_path = 'tmp/';
$types = array('image/gif', 'image/png', 'image/jpeg'); // Допустимый тип файла
$size = 10240000; // Максимальный размер файла
// Обработка запроса
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Проверяем тип файла
    if (!in_array($_FILES['picture']['type'], $types))
        die('Неверный тип файла. <a href="?">Попробовать другой файл?</a>');
    // Проверяем размер файла
    if ($_FILES['picture']['size'] > $size)
        die('Недопустимый размер файла. <a href="?">Попробовать другой файл?</a>');
    // Загрузка файла и вывод сообщения
    if (!copy($_FILES['picture']['tmp_name'], $path . $_FILES['picture']['name'])) {
        echo 'Что-то пошло не так';
    } else
        echo 'картинка успешно загружена <a href="gallery.php">Перетий в галерею</a> ';
}
?>

</body>
</html>