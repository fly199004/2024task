<?php
// 引入数据库连接配置
$env = parse_ini_file('./.env');

$host = $env["host"];
$username = $env["username"];
$password = $env["password"];
$database = $env["database"];

// 创建数据库连接
$conn = new mysqli($host, $username, $password);

// 检查连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

// 创建数据库
$sql = "CREATE DATABASE IF NOT EXISTS $database";
if ($conn->query($sql) === TRUE) {
    echo "数据库创建成功";
} else {
    echo "创建数据库错误: " . $conn->error;
}

// 选择数据库
$conn->select_db($database);

// 读取并执行 init.sql 文件中的 SQL 命令
$sqlCommands = file_get_contents('./database/init.sql');
$commands = explode(';', $sqlCommands);
foreach ($commands as $command) {
    $command = trim($command);
    if (!empty($command)) {
        if ($conn->query($command) === FALSE) {
            echo "错误: " . $conn->error;
        }
    }
}

// 关闭连接
$conn->close();
?>