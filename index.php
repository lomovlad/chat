<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Chat;

$chat = new Chat();

//Логика отправки данных сообщения
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['message'])) {
    $chat->sendMessage($_POST['message']);
}

// Получаем сообщения из БД
$messages = $chat->getMessages();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chat</title>
    <!-- Подключаем Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center mb-4">Привет, испугался? Не бойся, я чат</h2>
    <!-- Форма для отправки сообщения -->
    <form action="" method="POST" class="d-flex mb-4">
        <!--suppress HtmlFormInputWithoutLabel -->
        <textarea name="message" class="form-control me-2" rows="2" placeholder="Введите сообщение..."></textarea>
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
    <!-- Блок для сообщений -->
    <div id="messages" class="border rounded p-3 mb-4 bg-white" style="height: 50vh; overflow-y: scroll;">
        <?php
        // Вывод сообщений
        foreach ($messages as $message) {
            // Создаем объект DateTime со временем UTC
            $dateTime = new DateTime($message['created_at'], new DateTimeZone('UTC'));
            // Устанавливаем локальный часовой пояс
            $dateTime->setTimezone(new DateTimeZone('Europe/Moscow'));
            // Форматируем время
            $formattedTime = $dateTime->format('d.m H:i');
            // Выводим сообщение с отформатированным временем
            echo "<p>[$formattedTime] <strong>" . htmlspecialchars($message['message']) . "</strong></p>";
        }
        ?>
    </div>
</div>
</body>
</html>
