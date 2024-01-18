<?php
include '../../config/db_config.php'; // 包含数据库连接配置

// 增加账目条目
function createEntry($userId, $categoryId, $price, $description, $time, $level)
{
    global $conn;
    $sql = "INSERT INTO entries (user_id, category_id, price, description, time, level) VALUES (:user_id, :category_id, :price, :description, :time, :level)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $userId);
    $stmt->bindParam(':category_id', $categoryId);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':time', $time);
    $stmt->bindParam(':level', $level);
    $stmt->execute();
    return $conn->lastInsertId(); // 返回新创建的条目ID
}

// 获取所有账目条目
function getEntries($userId)
{
    global $conn;
    $sql = "SELECT * FROM entries WHERE user_id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $userId);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// 获取单个账目条目
function getEntry($id)
{
    global $conn;
    $sql = "SELECT * FROM entries WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// 更新账目条目
function updateEntry($id, $userId, $categoryId, $price, $description, $date, $level)
{
    global $conn;
    $sql = "UPDATE entries SET user_id = :user_id, category_id = :category_id, price = :price, description = :description, date = :date, level = :level WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $userId);
    $stmt->bindParam(':category_id', $categoryId);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':level', $level);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}

// 删除账目条目
function deleteEntry($id)
{
    global $conn;
    $sql = "DELETE FROM entries WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}
