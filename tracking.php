<?php
// Начинаем сессию для авторизации
session_start();
// Подключаем базу данных
require 'configDB.php';

// Получаем все грузы из базы данных
$sql = 'SELECT * FROM cargo ORDER BY id DESC';
$query = $pdo->query($sql);
$cargos = $query->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Отслеживание груза по номеру накладной</title>
    <!-- Мета-теги для SEO -->
    <meta name="description" content="Отслеживание груза по номеру накладной. Узнайте текущий статус вашего отправления">
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
            echo ' → <span style="color: #333;">Отслеживание груза</span>';
            echo '</div>';
            ?>
        </div>

        <section class="main" style="padding: 40px 0;">
            <div class="box">
                <h2>Отследить груз</h2>
                <p>Введите номер накладной, чтобы узнать статус отправления</p>
            </div>
        </section>

        <section class="calc">
            <div class="box">
                <!-- Форма поиска груза -->
                <div class="calc-in">
                    <div>
                        <label for="track-number">Номер накладной</label>
                        <input type="text" id="track-number" placeholder="Например: TK-1234-2025">
                    </div>
                    <button id="track-btn" class="btn" style="width: 100%;">Отследить</button>
                    
                    <!-- Результат поиска -->
                    <div id="track-result" style="display: none; margin-top: 20px; padding: 15px; background: #3498db; color: white; border-radius: 5px;">
                        Статус: <span id="status"></span><br>
                        Местоположение: <span id="location"></span>
                    </div>
                </div>

                <!-- Таблица всех грузов -->
                <h3 style="margin-top: 40px;">Все грузы</h3>
                <table class="tbl">
                    <table>
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
            </div>
        </section>
    </main>

    <!-- Подвал сайта -->
    <footer class="foot">
        <div class="box">
            <p>© 2026 ТК "Логист". Все права защищены.</p>
        </div>
    </footer>

    <!-- Передаём данные из PHP в JavaScript -->
    <script>
        // Данные о грузах из базы данных
        const cargosData = <?= json_encode($cargos) ?>;
    </script>
    <script src="script.js"></script>
</body>
</html>