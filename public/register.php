<?php
require_once 'conect.php'; // подключение к базе данных
session_start();

// === Авторизация через почту ===
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email']) && isset($_POST['password'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Проверим, есть ли пользователь с таким email
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows > 0) {
        // === Пользователь найден: вход ===
        $user = $res->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'email' => $user['email']
            ];
            header("Location: profile.php");
            exit();
        } else {
            $error = "Неверный пароль.";
        }
    } else {
        // === Пользователь не найден: регистрируем ===
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $hash);
        if ($stmt->execute()) {
            $_SESSION['user'] = [
                'id' => $stmt->insert_id,
                'email' => $email
            ];
            header("Location: profile.php");
            exit();
        } else {
            $error = "Ошибка при регистрации.";
        }
    }
}
?>
