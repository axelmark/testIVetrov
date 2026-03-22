<?php
require_once 'classes/ImageManager.php';

$manager = new ImageManager();
$images = $manager->getAllImages();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Галерея изображений</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
            max-width: 1200px;
            margin: 0 auto;
        }
        .grid-item {
            background: #f8f9fa;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }
        .grid-item:hover {
            transform: scale(1.02);
        }
        .grid-item img {
            width: 100%;
            height: auto;
            aspect-ratio: 1 / 1;
            object-fit: cover;
            display: block;
        }
        .empty {
            text-align: center;
            font-size: 18px;
            color: #6c757d;
            margin-top: 50px;
        }
    </style>
</head>
<body>
<h1>Галерея загруженных изображений</h1>
<?php if (empty($images)): ?>
    <div class="empty">Нет загруженных изображений</div>
<?php else: ?>
    <div class="grid">
        <?php foreach ($images as $image): ?>
            <div class="grid-item">
                <img src="uploads/<?= htmlspecialchars($image) ?>" alt="Изображение">
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
</body>
</html>
