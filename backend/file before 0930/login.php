<?php
$host = "localhost";        // MySQL 服务器
$dbname = "0909task";   // 数据库名称
$username = "root";         // MySQL 用户名
$password = "123456";             // MySQL 密码

try {
    // 创建 PDO 数据库连接
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 检查是否收到 POST 请求
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // 获取用户输入的用户名和密码
        $inputUsername = $_POST['username'];
        $inputPassword = $_POST['password'];

        // 查询数据库是否存在匹配的用户名和密码
        $stmt = $pdo->prepare("SELECT * FROM login WHERE username = :username AND password = :password");
        $stmt->bindParam(':username', $inputUsername);
        $stmt->bindParam(':password', $inputPassword);
        $stmt->execute();

        // 检查是否找到用户
        if ($stmt->rowCount() > 0) {
            echo "<script>alert('登录成功！欢迎，" . $inputUsername . "');</script>";
            echo "Login successful! Welcome, " . $inputUsername;
        } else {
            echo "<script>alert('登录失败！用户名或密码无效。');</script>";
            echo "Login failed! Invalid username or password.";
        }
    }
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>