<?php
include '../../database/categories.php';

$categories = getCategories();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Record Bill</title>
    <!-- 这里可以添加样式和脚本 -->
</head>

<body>
    <h1>Record an account entry</h1>
    <form action="record.php" method="post">
        <div>
            <label>Money:</label>
            <input type="number" name="amount" />
        </div>
        <div>
            <label>Date and Time:</label>
            <input type="datetime-local" name="time">
        </div>
        <div>
            <label>Category</label>
            <select name="category">
                <option value="">--Please choose an option--</option>
                <?php foreach ($categories as $category) : ?>
                    <option value="<?php echo $category['id']; ?>">
                        <?php echo htmlspecialchars($category['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label>Description</label>
            <textarea name="description"></textarea>
        </div>
        <div>
            <label>Level</label>
            <select name="level">
                <option value="">--Please choose an option--</option>
                <option value="0">正常价格</option>
                <option value="1">小奢小贵</option>
                <option value="2">大项支出</option>
            </select>
        </div>
        <div>
            <input type="submit" value="submit" />
        </div>
    </form>
</body>

</html>

<?php
session_start();

// 如果用户未登录，跳转到登录页面
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login/login.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $price = $_POST['amount'];
    // $time = strtotime($_POST['time']);
    $time = $_POST['time'];
    $categoryId = $_POST['category'];
    $description = $_POST['description'];
    $level = $_POST['level'];

    include '../../database/entries.php';
    $userId = $_SESSION['user_id'];

    // echo "<script type='text/javascript'>alert('$time');</script>";

    if ($userId && $categoryId && $price && $time !== null && $level !== null) {
        createEntry($userId, $categoryId, $price, $description, $time, $level);
        header('Location: ../home/home.php');
        exit();
    } else {
        $message = 'Please fill in all required fields.';
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
}
