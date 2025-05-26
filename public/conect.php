<?php
$servername = "sql305.infinityfree.com";
$username = "if0_39087838";
$password = "7uZcBp17M8FN1n";
$database = "if0_39087838_certicraft"; 

$conn = new mysqli($servername, $username, $password, $database);

// Проверка подключения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}
?>
