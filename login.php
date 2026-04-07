<?php
session_start();
require 'configDB.php';

if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $sql = 'SELECT * FROM users WHERE email = ?';
    $query = $pdo->prepare($sql);
    $query->execute([$email]);
    $user = $query->fetch(PDO::FETCH_OBJ);
    
    if($user && password_verify($password, $user->password)) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_name'] = $user->name;
        header('Location: cabinet.php');
    } else {
        $error = 'Неверный email или пароль';
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход в личный кабинет</title>
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
            echo ' → <span style="color: #333;">Вход</span>';
            echo '</div>';
            ?>
        </div>

        <section class="main" style="padding: 40px 0;">
            <div class="box">
                <h2>Вход в личный кабинет</h2>
                
                <?php if(isset($_GET['registered'])): ?>
                    <div style="color: green; margin-bottom: 20px;">Регистрация успешна! Войдите в аккаунт</div>
                <?php endif; ?>
                
                <?php if(isset($error)): ?>
                    <div style="color: red; margin-bottom: 20px;"><?= $error ?></div>
                <?php endif; ?>
                
                <form method="POST" class="calc-in" style="max-width: 400px;">
                    <div>
                        <label>Email</label>
                        <input type="email" name="email" placeholder="example@mail.ru" required>
                    </div>
                    <div>
                        <label>Пароль</label>
                        <input type="password" name="password" placeholder="••••••••" required>
                    </div>
                    <button type="submit" name="login" class="btn" style="width: 100%;">Войти</button>
                </form>
            </div>
        </section>
    </main>

    <footer class="foot">
        <div class="box">
            <p>© 2026 ТК "Логист". Все права защищены.</p>
        </div>
    </footer>
</body>
</html>