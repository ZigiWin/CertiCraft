<?php
session_start();
require 'conect.php';

if (!isset($_GET['token'])) {
    $_SESSION['error'] = 'Некорректная ссылка подтверждения.';
    header('Location: auth.php');
    exit;
}

$token = $_GET['token'];

// Проверим, существует ли пользователь с таким токеном
$stmt = $conn->prepare("SELECT id FROM users WHERE verify_token = ?");
$stmt->bind_param("s", $token);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    $_SESSION['error'] = 'Неверный или устаревший токен.';
    header('Location: auth.php');
    exit;
}

$stmt->bind_result($user_id);
$stmt->fetch();

// Подтверждаем
$stmt = $conn->prepare("UPDATE users SET is_verified = 1, verify_token = NULL WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();

$_SESSION['error'] = 'Email подтверждён! Теперь вы можете войти.';
header('Location: auth.php');
exit;
