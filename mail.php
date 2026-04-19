<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pryg_skok_db";

// 1. Создаем подключение
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем на ошибки
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $form_type = isset($_POST['form_type']) ? $_POST['form_type'] : 'order';

    // 2. Обработка данных (оставляем твою проверку)
    if ($form_type == 'contacts') {
        $name = htmlspecialchars(trim($_POST['user_fio']));
        $email = htmlspecialchars(trim($_POST['user_email']));
        $phone = "-"; // В контактах нет телефона
        $game_title = "Обратная связь"; 
        
        if (empty($name) || empty($email)) {
            die("Пожалуйста, заполните все поля формы контактов.");
        }
    } else {
        $name = htmlspecialchars(trim($_POST['user_name']));
        $phone = htmlspecialchars(trim($_POST['user_phone']));
        $email = htmlspecialchars(trim($_POST['user_email']));
        $game_title = htmlspecialchars(trim($_POST['game_title']));

        if (empty($name) || empty($phone) || empty($game_title)) {
            die("Пожалуйста, заполните основные поля заказа.");
        }
    }

    // 3. ЗАПРОС В БАЗУ ДАННЫХ
    $sql = "INSERT INTO orders (user_name, user_phone, user_email, game_title) 
            VALUES ('$name', '$phone', '$email', '$game_title')";

    if ($conn->query($sql) === TRUE) {
        // Если в базу записалось, выводим твой красивый HTML
        echo "<!DOCTYPE html>
        <html lang='ru'>
        <head>
            <meta charset='UTF-8'>
            <title>Спасибо за заявку!</title>
            <style>
                body { font-family: 'Montserrat', sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; background: #fdfaf5; margin: 0; }
                .box { padding: 40px; background: white; border-radius: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); text-align: center; max-width: 400px; }
                h1 { color: #cb1f2d; font-size: 24px; margin-bottom: 10px; }
                p { color: #333; margin-bottom: 25px; }
                a { display: inline-block; background: #ff0000; color: #fff; text-decoration: none; padding: 12px 30px; border-radius: 12px; font-weight: bold; transition: 0.3s; }
                a:hover { background: #d60000; transform: translateY(-2px); }
            </style>
        </head>
        <body>
            <div class='box'>
                <h1>Заявка принята!</h1>
                <p>Данные успешно сохранены в базу (MySQL). Мы свяжемся с вами в ближайшее время!</p>
                <a href='index.html'>Вернуться на сайт</a>
            </div>
        </body>
        </html>";
    } else {
        echo "Ошибка базы данных: " . $conn->error;
    }

    // 4. Закрываем соединение
    $conn->close();

} else {
    header("Location: index.html");
    exit;
}
?>