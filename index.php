<?php
var_dump([1 => 2]);
$pdo = new PDO('sqlite:my_db.db');

//$db = mysqli_connect('192.168.1.68', 'root', '12345678', 'chat', '3306');
//var_dump($res->execute([$message]))
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['message'])) {
    $message = $_POST['message'];
    $sqlAddMessage = 'INSERT INTO messages (message) VALUES (:message)';
    $res = $pdo->prepare($sqlAddMessage);
    $res->
    var_dump($res->execute([':message'=>$message]));



    // После успешного добавления сообщения перенаправляем на ту же страницу
    header('Location: index.php');
    die;
}


//$res = mysqli_query($db, "SELECT * FROM `messages`");  /*Получить сообщения*/

$messages = [];

while ($message = mysqli_fetch_assoc($res)) {
    $messages[] = $message;
}

$messages = array_reverse($messages);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chat</title>
    <!-- Подключаем Bootstrap -->
    <!--suppress JSUnresolvedLibraryURL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center mb-4">Привет, испугался? Не бойся, я чат</h2>

    <!-- Блок для сообщений -->
    <div id="messages" class="border rounded p-3 mb-4 bg-white" style="height: 300px; overflow-y: scroll;">
        <?php
        // Выводим сообщения

        foreach ($messages as $message) {
            // Создаем объект DateTime со временем UTC
            $dateTime = new DateTime($message['current_time'], new DateTimeZone('UTC'));

            // Устанавливаем локальный часовой пояс
            $dateTime->setTimezone(new DateTimeZone('Europe/Moscow'));

            // Форматируем время
            $formattedTime = $dateTime->format('d.m H:i');

            // Выводим сообщение с отформатированным временем
            echo "<p>[$formattedTime] <strong>" . htmlspecialchars($message['message']) . "</strong></p>";
        }
        ?>
    </div>


    <!-- Форма для отправки сообщения -->
    <form action="" method="POST" class="d-flex">
        <!--suppress HtmlFormInputWithoutLabel -->
        <input type="text" name="message" class="form-control me-2" placeholder="Введите сообщение..." required>
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
</div>

</body>
</html>
