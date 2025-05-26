<?php
session_start();
if (!empty($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход или регистрация</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/register.css">
</head>
<body>
    <div class="page-container">
        <h2 class="brand-name"><a href="main.php" style="text-decoration: none; color: #615F5F">CertiCraft</a></h2>

        <div class="container">
            <div class="login-box">
                <p class="vhod">Вход или Регистрация</p>

                <!-- Соцсети -->
                <div class="social-buttons">
                    <button class="google"><a href="login_with.php?provider=Google">Google</a></button>
                    <button class="vk"><a href="login_with.php?provider=Vkontakte">ВКонтакте</a></button>
                    <button class="yandex"><a href="login_with.php?provider=Yandex">Yandex</a></button>
                    <button class="mailru"><a href="login_with.php?provider=Mailru">Mail.ru</a></button>
                </div>

                <p>или введите почту и пароль:</p>

                <!-- Почта+Пароль -->
                <form method="POST" action="register_or_login.php">
                    <input type="email" name="email" placeholder="Адрес электронной почты" class="email-input" required><br>
                    <input type="password" name="password" placeholder="Пароль" class="email-input" required><br>
                    <button type="submit" class="next-button">Продолжить</button>
                </form>

                <?php if (!empty($error)): ?>
                    <div class="error" style="color: red; margin-top: 10px;"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
