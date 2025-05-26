<?php
$host = 'dpg-d0qdjlodl3ps73esect0-a';
$port = 5432;
$dbname = 'certicraft';
$user = 'admin';
$password = 'HwR6Pv9v2QIRogC3NeH2s8hWT1lXSOJl';

$dsn = "pgsql:host=$host;port=$port;dbname=$dbname";

try {
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Включить выброс исключений при ошибках
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // Удобный режим выборки
    ]);
    echo "Подключение к PostgreSQL через PDO успешно!";
} catch (PDOException $e) {
    die("Ошибка подключения: " . $e->getMessage());
}
?>
