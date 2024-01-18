<?php
include '../../config/db_config.php';

// 创建用户
function createUser($username, $password)
{
    global $conn;
    $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";

    $stmt = $conn->prepare($sql);
    $stmt->execute([':username' => $username, ':password' => $password]);
}

// 获取用户信息
function getUser($userId)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = :userId");
    $stmt->execute([':userId' => $userId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// 获取用户信息
function getUserByUsername($username)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute([':username' => $username]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// 更新用户信息
function updateUser($userId, $username, $password)
{
    global $conn;
    $sql = "UPDATE users SET username = :username, password = :password WHERE id = :userId";

    $stmt = $conn->prepare($sql);
    $stmt->execute([':username' => $username, ':password' => $password, ':userId' => $userId]);
}

// 删除用户
function deleteUser($userId)
{
    global $conn;
    $stmt = $conn->prepare("DELETE FROM users WHERE id = :userId");
    $stmt->execute([':userId' => $userId]);
}
