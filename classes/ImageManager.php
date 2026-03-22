
<?php

class ImageManager
{
    private string $uploadDir;
    private array $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    private int $maxSize = 5 * 1024 * 1024; // 5 МБ

    public function __construct(string $uploadDir = 'uploads/')
    {
        $this->uploadDir = rtrim($uploadDir, '/') . '/';
        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0755, true);
        }
    }

    /**
     * Загружает файл на сервер
     *
     * @param array $file элемент $_FILES['image']
     * @return array ['success' => bool, 'message' => string, 'filename' => string|null]
     */
    public function upload(array $file): array
    {
        // Проверка ошибок загрузки
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return ['success' => false, 'message' => $this->getUploadErrorMessage($file['error'])];
        }

        // Проверка типа файла
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        if (!in_array($mimeType, $this->allowedTypes)) {
            return ['success' => false, 'message' => 'Недопустимый тип файла. Разрешены только JPG, PNG, GIF, WEBP.'];
        }

        // Проверка размера
        if ($file['size'] > $this->maxSize) {
            return ['success' => false, 'message' => 'Файл слишком большой. Максимальный размер 5 МБ.'];
        }

        // Генерация уникального имени
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . '.' . $extension;
        $destination = $this->uploadDir . $filename;

        // Перемещение файла
        if (move_uploaded_file($file['tmp_name'], $destination)) {
            return ['success' => true, 'message' => 'Файл успешно загружен', 'filename' => $filename];
        } else {
            return ['success' => false, 'message' => 'Ошибка при сохранении файла'];
        }
    }

    /**
     * Возвращает список всех изображений в папке uploads
     *
     * @return array список имён файлов
     */
    public function getAllImages(): array
    {
        $files = scandir($this->uploadDir);
        $images = [];

        foreach ($files as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }

            $filePath = $this->uploadDir . $file;
            if (is_file($filePath)) {
                $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                    $images[] = $file;
                }
            }
        }

        return $images;
    }

    private function getUploadErrorMessage(int $errorCode): string
    {
        switch ($errorCode) {
            case UPLOAD_ERR_INI_SIZE:
                return 'Файл превышает максимальный размер, указанный в php.ini';
            case UPLOAD_ERR_FORM_SIZE:
                return 'Файл превышает максимальный размер, указанный в HTML-форме';
            case UPLOAD_ERR_PARTIAL:
                return 'Файл был загружен только частично';
            case UPLOAD_ERR_NO_FILE:
                return 'Файл не был загружен';
            case UPLOAD_ERR_NO_TMP_DIR:
                return 'Отсутствует временная папка';
            case UPLOAD_ERR_CANT_WRITE:
                return 'Не удалось записать файл на диск';
            case UPLOAD_ERR_EXTENSION:
                return 'Загрузка файла остановлена расширением PHP';
            default:
                return 'Неизвестная ошибка загрузки';
        }
    }
}
