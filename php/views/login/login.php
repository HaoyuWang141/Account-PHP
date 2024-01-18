<?php
include '../../database/users.php'; // 包含数据库连接

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 获取用户名和密码
    $username = $_POST["username"];
    $password = $_POST["password"];

    // 数据库查询
    try {
        $user = getUserByUsername($username);
        // $user['id'] = 1;
        // $user['username'] = 'testUser';
        // $user['password'] = '111111';

        if ($user) {
            if ($password === $user['password']) {
                // 登录成功
                // echo "Login successful!";
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['loggedin'] = true;

                // 这里可以设置 session 或重定向到另一个页面
                header("Location: /views/home/home.php");
            } else {
                // 密码不正确
                echo "Invalid username or password.";
            }
        } else {
            // 用户名不存在
            echo "<script type='text/javascript'>alert('Invalid username or password.');</script>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
    </head>
    <body>
        <h2>Login</h2>
        <form action="login.php" method="post">
            <label for="username">Username:</label>
            <input
                type="text"
                id="username"
                name="username"
                required
            /><br /><br />

            <label for="password">Password:</label>
            <input
                type="password"
                id="password"
                name="password"
                required
            /><br /><br />

            <button type="submit">Login</button>
        </form>
    </body>
</html>

