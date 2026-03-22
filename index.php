<?php
require_once 'classes/ImageManager.php';
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Загрузка изображения</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        .container {
            max-width: 500px;
            margin: 0 auto;
            text-align: center;
        }
        input[type="file"] {
            display: none;
        }
        .upload-btn {
            display: inline-block;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
        .upload-btn:hover {
            background: #0056b3;
        }
        .message {
            margin-top: 20px;
            padding: 10px;
            border-radius: 5px;
            display: none;
        }
        .success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .loader {
            display: none;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Загрузка изображения</h1>
    <label for="imageUpload" class="upload-btn">Обзор</label>
    <input type="file" id="imageUpload" accept="image/jpeg,image/png,image/gif,image/webp">
    <div class="loader">Загрузка...</div>
    <div class="message" id="message"></div>
</div>

<script>
    document.getElementById('imageUpload').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (!file) return;

        const formData = new FormData();
        formData.append('image', file);

        const messageDiv = document.getElementById('message');
        const loader = document.querySelector('.loader');

        // Очистка предыдущих сообщений
        messageDiv.style.display = 'none';
        messageDiv.className = 'message';
        loader.style.display = 'block';

        fetch('upload.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            loader.style.display = 'none';
            messageDiv.textContent = data.message;
            messageDiv.classList.add(data.success ? 'success' : 'error');
            messageDiv.style.display = 'block';

            // Очищаем input, чтобы можно было загрузить тот же файл снова
            document.getElementById('imageUpload').value = '';
        })
        .catch(error => {
            loader.style.display = 'none';
            messageDiv.textContent = 'Ошибка сети или сервера';
            messageDiv.classList.add('error');
            messageDiv.style.display = 'block';
            console.error('Error:', error);
        });
    });
</script>
</body>
</html>
