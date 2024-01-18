<?php
include '../../config/db_config.php'; // 包含数据库连接配置

// 增加类别
function createCategory($name, $description)
{
    global $conn;
    $sql = "INSERT INTO categories (name, description) VALUES (:name, :description)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->execute();
    return $conn->lastInsertId(); // 返回新创建的类别ID
}

// 获取所有类别
function getCategories()
{
    global $conn;
    $sql = "SELECT * FROM categories";
    $stmt = $conn->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// 获取单个类别
function getCategory($id)
{
    global $conn;
    $sql = "SELECT * FROM categories WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// 更新类别
function updateCategory($id, $name, $description)
{
    global $conn;
    $sql = "UPDATE categories SET name = :name, description = :description WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}

// 删除类别
function deleteCategory($id)
{
    global $conn;
    $sql = "DELETE FROM categories WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}
