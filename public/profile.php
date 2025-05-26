<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: auth.php');
    exit;
}
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title>Личный кабинет</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/profile.css">
</head>
<body>
  <div class="profile-container">
    <div class="profile-card">
      <img src="<?= htmlspecialchars($user['avatar'] ?? 'img/default_avatar.png') ?>" class="avatar" alt="Аватар">
      <h2><?= htmlspecialchars($user['name'] ?? 'Пользователь') ?></h2>
      <p class="email"><?= htmlspecialchars($user['email']) ?></p>
      <p class="provider">Вход через: <?= htmlspecialchars($user['provider'] ?? 'почту') ?></p>
      <div class="actions">
        <a href="main.php" class="btn">Мои проекты</a>
        <a href="logout.php" class="btn logout">Выйти</a>
      </div>
    </div>
  </div>
</body>
</html>
