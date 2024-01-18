<?php
include '../../database/users.php'; // 包含数据库连接

session_start();

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <!-- 这里可以添加样式和脚本 -->
</head>

<body>
    <h1>Welcome to Home Page, <?php echo $username ?></h1>
    <div>
        <a href="../record/record.php">record</a> | <a href="../query/query.php">query</a>
    </div>
</body>

</html>