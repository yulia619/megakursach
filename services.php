<?php
// Начинаем сессию для авторизации
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Услуги грузоперевозок — перевозка сборных и крупногабаритных грузов</title>
    <!-- Мета-теги для SEO -->
    <meta name="description" content="Полный спектр услуг грузоперевозок: сборные грузы, крупногабарит, переезды. Работаем с юрлицами и физлицами">
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
            echo ' → <span style="color: #333;">Услуги</span>';
            echo '</div>';
            ?>
        </div>

        <section class="main" style="padding: 40px 0;">
            <div class="box">
                <h2>Наши услуги</h2>
            </div>
        </section>

        <!-- Сетка услуг (6 карточек) -->
        <section class="sec">
            <div class="box">
                <div class="row">
                    <!-- Карточка услуги 1: Сборные грузы -->
                    <div class="item">
                        <img src="img/service1.jpg" alt="Сборные грузы" style="width: 100%; height: 200px; object-fit: cover; border-radius: 5px; margin-bottom: 15px;">
                        <h3>Сборные грузы</h3>
                        <p>Объединяем грузы от разных отправителей в одну машину. Вы платите только за своё место.</p>
                    </div>
                    <!-- Карточка услуги 2: Крупногабарит -->
                    <div class="item">
                        <img src="img/service2.jpg" alt="Крупногабарит" style="width: 100%; height: 200px; object-fit: cover; border-radius: 5px; margin-bottom: 15px;">
                        <h3>Крупногабарит</h3>
                        <p>Перевозим негабаритные грузы любой сложности. Индивидуальный подбор транспорта.</p>
                    </div>
                    <!-- Карточка услуги 3: Переезды -->
                    <div class="item">
                        <img src="img/service3.jpg" alt="Переезды" style="width: 100%; height: 200px; object-fit: cover; border-radius: 5px; margin-bottom: 15px;">
                        <h3>Переезды</h3>
                        <p>Квартирные и офисные переезды под ключ. Упаковка, погрузка, транспортировка.</p>
                    </div>
                    <!-- Карточка услуги 4: Доставка документов -->
                    <div class="item">
                        <img src="img/service4.jpg" alt="Доставка документов" style="width: 100%; height: 200px; object-fit: cover; border-radius: 5px; margin-bottom: 15px;">
                        <h3>Доставка документов</h3>
                        <p>Срочная курьерская доставка корреспонденции и документов по городу.</p>
                    </div>
                    <!-- Карточка услуги 5: Складские услуги -->
                    <div class="item">
                        <img src="img/service5.jpg" alt="Складские услуги" style="width: 100%; height: 200px; object-fit: cover; border-radius: 5px; margin-bottom: 15px;">
                        <h3>Складские услуги</h3>
                        <p>Ответственное хранение грузов на наших складах. Удобные подъезды.</p>
                    </div>
                    <!-- Карточка услуги 6: Страхование -->
                    <div class="item">
                        <img src="img/service6.jpg" alt="Страхование" style="width: 100%; height: 200px; object-fit: cover; border-radius: 5px; margin-bottom: 15px;">
                        <h3>Страхование</h3>
                        <p>Все грузы застрахованы. Полная материальная ответственность.</p>
                    </div>
                </div>
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