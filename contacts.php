<?php
// Начинаем сессию для авторизации (чтобы показывать правильное меню)
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Контакты транспортной компании</title>
    <!-- Мета-теги для SEO -->
    <meta name="description" content="Адрес офиса, телефоны, email, режим работы. Карта проезда и адреса терминалов">
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
                <!-- Кнопка бургер-меню для мобильных устройств -->
                <button class="burger">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <!-- Главное меню навигации -->
                <ul class="menu">
                    <li><a href="index.php">Главная</a></li>
                    <li><a href="services.php">Услуги</a></li>
                    <li><a href="calculator.php">Калькулятор</a></li>
                    <li><a href="tracking.php">Отследить груз</a></li>
                    <li><a href="contacts.php">Контакты</a></li>
                    <!-- Показываем разные пункты меню в зависимости от того, авторизован ли пользователь -->
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

    <!-- Основной контент страницы -->
    <main>
        <!-- Хлебные крошки (навигационная цепочка) -->
        <div class="box" style="padding: 20px 0;">
            <?php
            // Выводим путь: Главная → Контакты
            echo '<div style="margin: 10px 0 20px; color: #666;">';
            echo '<a href="index.php" style="color: #3498db; text-decoration: none;">Главная</a>';
            echo ' → <span style="color: #333;">Контакты</span>';
            echo '</div>';
            ?>
        </div>

        <!-- Заголовок страницы -->
        <section class="main" style="padding: 40px 0;">
            <div class="box">
                <h2>Контакты</h2>
            </div>
        </section>

        <!-- Блок с контактной информацией (сетка из 4 карточек) -->
        <section class="sec">
            <div class="box">
                <div class="row">
                    <!-- Телефоны -->
                    <div class="item">
                        <h3>Телефон</h3>
                        <p>8 (800) 123-45-67</p>
                        <p>+7 (495) 123-45-67</p>
                    </div>
                    <!-- Email-адреса -->
                    <div class="item">
                        <h3>Email</h3>
                        <p>info@logist.ru</p>
                        <p>zakaz@logist.ru</p>
                    </div>
                    <!-- Физический адрес офиса -->
                    <div class="item">
                        <h3>Адрес офиса</h3>
                        <p>г. Ярославль, ул. Труфанова, д. 24</p>
                    </div>
                    <!-- Режим работы -->
                    <div class="item">
                        <h3>Режим работы</h3>
                        <p>Пн-Пт: 9:00 - 20:00</p>
                        <p>Сб-Вс: 10:00 - 18:00</p>
                    </div>
                </div>
                
                <!-- Интерактивная карта проезда (Google Maps) -->
                <div style="margin-top: 40px; text-align: center;">
                    <h3>Схема проезда</h3>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2132.9003525653916!2d39.76796897719431!3d57.68417197385985!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46b28e16b5c4b45b%3A0x9c3042bc819f15a!2z0YPQuy4g0KLRgNGD0YTQsNC90L7QstCwLCAyNCwg0K_RgNC-0YHQu9Cw0LLQu9GMLCDQr9GA0L7RgdC70LDQstGB0LrQsNGPINC-0LHQuy4sIDE1MDA0NQ!5e0!3m2!1sru!2sru!4v1774960231379!5m2!1sru!2sru" width="100%" height="450" style="border:0; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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