<?php
global $conn;
include 'config/db_config.php'; // 包含数据库连接配置
include 'database/users.php';    // 包含用户操作函数

// 测试数据库连接
try {
    $conn->query("SELECT 1");
    echo "Database connection successful.\n";
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// 插入新用户
$username = "Haoyu";
$password = "111111";
createUser($username, $password);
echo "User created successfully.\n";

// 查询刚创建的用户
$userId = $conn->lastInsertId(); // 获取最后插入行的ID
$user = getUser($userId);
echo "Retrieved user: \n";
print_r($user);
