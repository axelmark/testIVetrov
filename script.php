<?php


class ImageGallery
{
    var $UserID;
    private $GalleryPath = 'gallery/';
    private $Size = 102400;

    public function __construct($UserID)
    {
        $this->UserID = $UserID;
    }

    public function Save($sourcePath, $fileType, $originalName)
    {
        // Проверяем тип файла
        if (!in_array($fileType, array('image/gif', 'image/png', 'image/jpeg')))
            throw new Exception('Неверный тип файла. ');

        // Проверяем размер файла
        if ($_FILES['myfile']['size'] > $this->Size)
            throw new Exception('Недопустимый размер файла.');

        // Загрузка файла
        if (!move_uploaded_file('' . $sourcePath, '' . $this->GalleryPath . '' . $originalName)) {
            throw new Exception('Что-то пошло не так');
        } else {
            throw new Exception('картинка успешно загружена ');
        }
    }

    public function GetList()
    {
        //echo "tralala!";
    }
}