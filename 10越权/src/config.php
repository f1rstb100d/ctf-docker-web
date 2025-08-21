<?php
// 数据库配置
$host  = 'localhost';
$dbname  = 'web';
$db_user  = 'root';
$db_pass  = 'root';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed.");
}

session_start();
?>