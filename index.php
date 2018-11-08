<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
<form method="post" enctype="multipart/form-data" id="upload">
    <input type="file" name="picture">
    <input type="submit" value="Загрузить">
</form>


<script>
    $(document).ready(function () {

        $('#upload').submit(function () {
            $.ajax({
                type: "POST",
                url: "index.php",
                data: $(this).serialize()
            }).done(function () {

                alert("ok!!");

                $("#upload").trigger("reset");
                <?php echo 'nn'. DFG();?>
            });
            return false;
        });

    });
</script>


<?php
DFG();
function DFG()
{
// Пути загрузки файлов
    $path = './gallery/';
    $tmp_path = 'tmp/';
    $types = array('image/gif', 'image/png', 'image/jpeg'); // Допустимый тип файла
    $size = 1024000; // Максимальный размер файла

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
return "eerett";
}

?>


</body>
</html>