<?php
session_start();
header('Content-Type: application/json');

if (isset($_SESSION['user'])) {
    echo json_encode([
        'auth' => true,
        'name' => $_SESSION['user']['name'] ?? 'Пользователь',
        'avatar' => $_SESSION['user']['avatar'] ?? 'img/default_avatar.png'
    ]);
} else {
    echo json_encode(['auth' => false]);
}
