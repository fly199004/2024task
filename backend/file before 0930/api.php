<?php
// 设置允许跨域
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

include 'db.php';  // 引入数据库连接文件

try {
    // 查询所有用户信息
    $stmt = $pdo->query("SELECT * FROM login");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // 将数据以 JSON 格式输出
    echo json_encode($users);
} catch (Exception $e) {
    // 捕获异常并返回错误信息
    echo json_encode(['error' => $e->getMessage()]);
}
?>