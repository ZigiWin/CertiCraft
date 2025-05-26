<?php
session_start();
require 'conect.php';
require 'send_mail.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $username = explode('@', $email)[0];
    $token = bin2hex(random_bytes(32));
    
    $stmt = $conn->prepare("SELECT id, password_hash, is_verified FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Пользователь существует
        $stmt->bind_result($id, $hash, $verified);
        $stmt->fetch();

        if (!password_verify($password, $hash)) {
            $_SESSION['error'] = 'Неверный пароль';
            header('Location: auth.php');
            exit;
        }
        if (!$verified) {
            $_SESSION['error'] = 'Подтвердите почту!';
            header('Location: auth.php');
            exit;
        }

        // Успешный вход
        $_SESSION['user'] = ['id' => $id, 'email' => $email];
        header('Location: profile.php');
        exit;
    } else {
        // Регистрация
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (username, email, password_hash, verify_token) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $password_hash, $token);

        if ($stmt->execute()) {
            $verifyLink = "http://mysite.local/CertiCraft/verify.php?token=$token";
            if (sendConfirmationEmail($email, $username, $verifyLink)) {
                $_SESSION['error'] = "Письмо отправлено на $email";
            } else {
                $_SESSION['error'] = "Не удалось отправить письмо.";
            }
        } else {
            $_SESSION['error'] = "Ошибка регистрации. Попробуйте снова.";
        }

        header('Location: auth.php');
        exit;
    }
}
