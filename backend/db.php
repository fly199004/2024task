<?php
$host = "localhost";      // MySQL 服务器主机名
$dbname = "0909task";  // 数据库名称
$username = "root";       // 数据库用户名
$password = "123456";           // 数据库密码

// 创建数据库连接
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // 设置 PDO 错误模式为异常模式
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>