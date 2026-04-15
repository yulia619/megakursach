<?php
// Начинаем сессию для авторизации
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Транспортная компания - грузоперевозки по России</title>
    <!-- Мета-теги для SEO -->
    <meta name="description" content="Транспортная компания предлагает грузоперевозки по России. Рассчитать стоимость доставки онлайн, отследить груз, оставить заявку">
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
        <!-- Главный баннер с фоном -->
        <section class="main" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('img/bg-main.jpg'); background-size: cover; background-position: center;">
            <div class="box">
                <h2>Грузоперевозки по России — надежно и быстро</h2>
                <p>Перевозим сборные грузы, крупногабарит, организуем переезды. Работаем с частными лицами и компаниями.</p>
                <div>
                    <a href="calculator.php" class="btn">Рассчитать стоимость</a>
                    <a href="tracking.php" class="btn btn2">Отследить груз</a>
                </div>
            </div>
        </section>

        <!-- Слайдер с акциями -->
        <section class="slide-block">
            <div class="box">
                <div class="slide-box">
                    <div class="slide-one active">
                        <img src="img/slide1.jpg" alt="Грузоперевозки" style="width: 100%; max-width: 600px; border-radius: 10px; margin-bottom: 15px;">
                        <h3>Грузоперевозки по России</h3>
                        <p>От 50 руб/км</p>
                    </div>
                    <div class="slide-one">
                        <img src="img/slide2.jpg" alt="Сборные грузы" style="width: 100%; max-width: 600px; border-radius: 10px; margin-bottom: 15px;">
                        <h3>Сборные грузы</h3>
                        <p>Экономия до 30%</p>
                    </div>
                    <div class="slide-one">
                        <img src="img/slide3.jpg" alt="Переезды" style="width: 100%; max-width: 600px; border-radius: 10px; margin-bottom: 15px;">
                        <h3>Переезды</h3>
                        <p>Под ключ</p>
                    </div>
                </div>
                <!-- Кнопки переключения слайдера -->
                <div class="slide-btn">
                    <button class="prev">←</button>
                    <button class="next">→</button>
                </div>
            </div>
        </section>

        <!-- Блок преимуществ -->
        <section class="sec">
            <div class="box">
                <h2>Почему выбирают нас</h2>
                <div class="row">
                    <div class="item">
                        <h3>Быстро</h3>
                        <p>Доставка точно в срок. Отслеживайте груз онлайн</p>
                    </div>
                    <div class="item">
                        <h3>Надежно</h3>
                        <p>Страхуем все грузы, несем полную ответственность</p>
                    </div>
                    <div class="item">
                        <h3>Удобно</h3>
                        <p>Онлайн-калькулятор, заявка за 1 минуту, личный кабинет</p>
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
    
    <script src="script.js"></script>
</body>
</html>