<?php
$conn = new mysqli('MySQL-8.2', 'root', '', 'CertiCraft');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
