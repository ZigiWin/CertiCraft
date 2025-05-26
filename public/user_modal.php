<?php
if (!isset($_SESSION)) session_start();

if (!isset($_SESSION['user'])) return;

$user = $_SESSION['user'];
$avatar = $user['avatar'] ?: 'img/default-avatar.png';
$name = $user['name'] ?: 'Пользователь';
$email = $user['email'] ?: 'Без email';
?>

<div id="userModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <img src="<?= htmlspecialchars($avatar) ?>" alt="Аватар" class="modal-avatar">
        <h2><?= htmlspecialchars($name) ?></h2>
        <p><?= htmlspecialchars($email) ?></p>
        <a href="logout.php" class="logout-button">Выйти</a>
    </div>
</div>
