<?php
session_start();
require 'configDB.php';

if(isset($_POST['add_request'])) {
    $from = $_POST['from'];
    $to = $_POST['to'];
    $weight = $_POST['weight'];
    $volume = $_POST['volume'];
    $user_id = $_SESSION['user_id'] ?? 0;
    
    $sql = 'INSERT INTO requests(user_id, from_city, to_city, weight, volume) VALUES(?, ?, ?, ?, ?)';
    $query = $pdo->prepare($sql);
    $query->execute([$user_id, $from, $to, $weight, $volume]);
    
    $success = 'Заявка отправлена!';
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Калькулятор грузоперевозок — рассчитать стоимость доставки</title>
    <meta name="description" content="Онлайн-калькулятор грузоперевозок. Быстрый расчет стоимости доставки груза по России">
    <link rel="stylesheet" href="style.css">
</head>
<body>
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
                <button class="burger">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <ul class="menu">
                    <li><a href="index.php">Главная</a></li>
                    <li><a href="services.php">Услуги</a></li>
                    <li><a href="calculator.php">Калькулятор</a></li>
                    <li><a href="tracking.php">Отследить груз</a></li>
                    <li><a href="contacts.php">Контакты</a></li>
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

    <main>
        <div class="box" style="padding: 20px 0;">
            <?php
            echo '<div style="margin: 10px 0 20px; color: #666;">';
            echo '<a href="index.php" style="color: #3498db; text-decoration: none;">Главная</a>';
            echo ' → <span style="color: #333;">Калькулятор</span>';
            echo '</div>';
            ?>
        </div>

        <section class="main" style="padding: 40px 0;">
            <div class="box">
                <h2>Калькулятор стоимости доставки</h2>
            </div>
        </section>

        <section class="calc">
            <div class="box">
                <?php if(isset($success)): ?>
                    <div style="background: #2ecc71; color: white; padding: 15px; margin-bottom: 20px; border-radius: 5px;">
                        <?= $success ?>
                        <?php if(!isset($_SESSION['user_id'])): ?>
                            <br><a href="register.php" style="color: white;">Зарегистрируйтесь</a>, чтобы видеть историю заявок
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <div class="calc-in">
                    <form method="POST">
                        <div>
                            <label for="from">Откуда (город)</label>
                            <input type="text" id="from" name="from" placeholder="Москва" required>
                        </div>
                        <div>
                            <label for="to">Куда (город)</label>
                            <input type="text" id="to" name="to" placeholder="Санкт-Петербург" required>
                        </div>
                        <div>
                            <label for="weight">Вес (кг)</label>
                            <input type="number" id="weight" name="weight" value="100" required>
                        </div>
                        <div>
                            <label for="volume">Объем (м³)</label>
                            <input type="number" id="volume" name="volume" value="1" required>
                        </div>
                        <button type="button" id="calc-btn" class="btn" style="width: 100%; margin-bottom: 10px;">Рассчитать</button>
                        <button type="submit" name="add_request" class="btn btn2" style="width: 100%;">Отправить заявку</button>
                    </form>
                    
                    <div id="result" class="result" style="display: none; margin-top: 20px; padding: 15px; background: #2ecc71; color: white; border-radius: 5px;">
                        Стоимость доставки: <span id="price">0</span> руб.
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="foot">
        <div class="box">
            <p>© 2026 ТК "Логист". Все права защищены.</p>
        </div>
    </footer>
    
    <script src="script.js"></script>
</body>
</html>