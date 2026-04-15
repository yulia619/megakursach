<?php
// Начинаем сессию для авторизации
session_start();
// Подключаем базу данных
require 'configDB.php';

// Обработка отправки формы регистрации
if(isset($_POST['register'])) {
    // Получаем данные из формы
    $name = $_POST['name'];
    $email = $_POST['email'];
    // Хэшируем пароль для безопасного хранения в базе данных
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phone = $_POST['phone'];
    
    // SQL-запрос на добавление нового пользователя
    $sql = 'INSERT INTO users(name, email, password, phone) VALUES(?, ?, ?, ?)';
    $query = $pdo->prepare($sql);
    
    try {
        // Выполняем запрос
        $query->execute([$name, $email, $password, $phone]);
        // Перенаправляем на страницу входа с сообщением об успехе
        header('Location: login.php?registered=1');
    } catch(PDOException $e) {
        // Если email уже существует, показываем ошибку
        $error = 'Email уже зарегистрирован';
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Шапка сайта -->
    <header class="head">
        <div class="box">
            <div class="head-top">
                <div class="logo">
                    <img src="img/logo.png" alt="ТК Логист" style="height: 90px;">
                </div>
                <div class="phone">
                    <p>8 (800) 123-45-67</p>
                    <p>info@logist.ru</p>
                </div>
            </div>
            <nav>
                <!-- Кнопка бургер-меню для мобильных -->
                <button class="burger">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <!-- Главное меню -->
                <ul class="menu">
                    <li><a href="index.php">Главная</a></li>
                    <li><a href="services.php">Услуги</a></li>
                    <li><a href="calculator.php">Калькулятор</a></li>
                    <li><a href="tracking.php">Отследить груз</a></li>
                    <li><a href="contacts.php">Контакты</a></li>
                    <!-- Показываем разные пункты меню в зависимости от авторизации -->
                    <?php if(isset($_SESSION['user_id'])): ?>
                        <li><a href="cabinet.php">Кабинет</a></li>
                        <li><a href="logout.php">Выйти</a></li>
                    <?php else: ?>
                        <li><a href="login.php">Вход</a></li>
                        <li><a href="register.php">Регистрация</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Основной контент -->
    <main>
        <!-- Хлебные крошки -->
        <div class="box" style="padding: 20px 0;">
            <?php
            // Выводим навигационную цепочку
            echo '<div style="margin: 10px 0 20px; color: #666;">';
            echo '<a href="index.php" style="color: #3498db; text-decoration: none;">Главная</a>';
            echo ' → <span style="color: #333;">Регистрация</span>';
            echo '</div>';
            ?>
        </div>

        <section class="main" style="padding: 40px 0;">
            <div class="box">
                <h2>Регистрация</h2>
                
                <!-- Выводим ошибку, если email уже занят -->
                <?php if(isset($error)): ?>
                    <div style="color: red; margin-bottom: 20px;"><?= $error ?></div>
                <?php endif; ?>
                
                <!-- Форма регистрации -->
                <form method="POST" class="calc-in" style="max-width: 400px;">
                    <div>
                        <label>Имя</label>
                        <input type="text" name="name" placeholder="Юлия Холодилова" required>
                    </div>
                    <div>
                        <label>Email</label>
                        <input type="email" name="email" placeholder="yua@mail.ru" required>
                    </div>
                    <div>
                        <label>Пароль</label>
                        <input type="password" name="password" placeholder="••••••••" required>
                    </div>
                    <div>
                        <label>Телефон</label>
                        <input type="tel" name="phone" placeholder="+7 (999) 123-45-67" required>
                    </div>
                    <button type="submit" name="register" class="btn" style="width: 100%;">Зарегистрироваться</button>
                </form>
                
                <!-- Ссылка на страницу входа для уже зарегистрированных пользователей -->
                <p style="text-align: center; margin-top: 20px;">
                    Уже есть аккаунт? <a href="login.php">Войти</a>
                </p>
            </div>
        </section>
    </main>

    <!-- Подвал сайта -->
    <footer class="foot">
        <div class="box">
            <p>© 2026 ТК "Логист". Все права защищены.</p>
        </div>
    </footer>
</body>
</html>