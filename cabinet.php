<?php
// Начинаем сессию для авторизации
session_start();
// Подключаем базу данных
require 'configDB.php';

// Проверяем, авторизован ли пользователь
if(!isset($_SESSION['user_id'])) {
    // Если не авторизован, отправляем на страницу входа
    header('Location: login.php');
    exit;
}

// Получаем ID текущего пользователя из сессии
$user_id = $_SESSION['user_id'];

// Получаем все заявки текущего пользователя из базы данных
$sql = 'SELECT * FROM requests WHERE user_id = ? ORDER BY created_at DESC';
$query = $pdo->prepare($sql);
$query->execute([$user_id]);
$requests = $query->fetchAll(PDO::FETCH_OBJ);

// Получаем все грузы текущего пользователя из базы данных
$sql = 'SELECT * FROM cargo WHERE user_id = ? ORDER BY updated_at DESC';
$query = $pdo->prepare($sql);
$query->execute([$user_id]);
$cargos = $query->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет</title>
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
                <!-- Главное меню (для авторизованных пользователей) -->
                <ul class="menu">
                    <li><a href="index.php">Главная</a></li>
                    <li><a href="services.php">Услуги</a></li>
                    <li><a href="calculator.php">Калькулятор</a></li>
                    <li><a href="tracking.php">Отследить груз</a></li>
                    <li><a href="contacts.php">Контакты</a></li>
                    <li><a href="cabinet.php">Кабинет</a></li>
                    <li><a href="logout.php">Выйти</a></li>
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
            echo ' → <a href="cabinet.php" style="color: #3498db; text-decoration: none;">Личный кабинет</a>';
            echo ' → <span style="color: #333;">Мои заявки</span>';
            echo '</div>';
            ?>
        </div>

        <div class="box" style="padding: 40px 0;">
            <!-- Приветствие пользователя -->
            <h2>Личный кабинет</h2>
            <p>Здравствуйте, <?= htmlspecialchars($_SESSION['user_name']) ?>!</p>
            
            <!-- Блок с заявками на перевозку -->
            <h3 style="margin-top: 30px;">Мои заявки на перевозку</h3>
            <?php if($requests): ?>
                <table class="tbl">
                    <tr>
                        <th>Откуда</th>
                        <th>Куда</th>
                        <th>Вес</th>
                        <th>Объем</th>
                        <th>Статус</th>
                        <th>Дата</th>
                    </tr>
                    <?php foreach($requests as $req): ?>
                    <tr>
                        <td><?= htmlspecialchars($req->from_city) ?></td>
                        <td><?= htmlspecialchars($req->to_city) ?></td>
                        <td><?= $req->weight ?> кг</td>
                        <td><?= $req->volume ?> м³</td>
                        <td><?= $req->status ?></td>
                        <td><?= date('d.m.Y', strtotime($req->created_at)) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p>У вас пока нет заявок. <a href="calculator.php">Создать заявку</a></p>
            <?php endif; ?>
            
            <!-- Блок с грузами для отслеживания -->
            <h3 style="margin-top: 30px;">Мои грузы</h3>
            <?php if($cargos): ?>
                <table class="tbl">
                    <tr>
                        <th>Номер накладной</th>
                        <th>Описание</th>
                        <th>Статус</th>
                        <th>Местоположение</th>
                    </tr>
                    <?php foreach($cargos as $cargo): ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($cargo->tracking_number) ?></strong></td>
                        <td><?= htmlspecialchars($cargo->description) ?></td>
                        <td><?= $cargo->status ?></td>
                        <td><?= htmlspecialchars($cargo->location) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p>У вас пока нет грузов для отслеживания.</p>
            <?php endif; ?>
        </div>
    </main>

    <!-- Подвал сайта -->
    <footer class="foot">
        <div class="box">
            <p>© 2026 ТК "Логист". Все права защищены.</p>
        </div>
    </footer>
</body>
</html>