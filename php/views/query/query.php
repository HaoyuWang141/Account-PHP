<?php
include '../../database/entries.php';
include '../../database/categories.php';

session_start();

// 如果用户未登录，跳转到登录页面
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login/login.php');
    exit();
}

$userId = $_SESSION['user_id'];
$entries = getEntries($userId);

// 处理筛选
$dateFilter = $_GET['date'] ?? null;
$categoryFilter = $_GET['category'] ?? null;
$levelFilter = $_GET['level'] ?? null;

function filterEntries($entry)
{
    global $dateFilter, $categoryFilter, $levelFilter;

    // 日期过滤
    if ($dateFilter && (date('Y-m-d', strtotime($entry['time'])) != $dateFilter)) {
        return false;
    }

    // 类别过滤
    if ($categoryFilter !== '' && ($entry['category_id'] != $categoryFilter)) {
        return false;
    }

    // 消费级别过滤
    if ($levelFilter !== '' && ($entry['level'] != $levelFilter)) {
        return false;
    }

    return true;
}

$filterEntries = array_filter($entries, 'filterEntries');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Query Bills</title>
    <!-- 添加样式和脚本 -->
    <link rel="stylesheet" type="text/css" href="query.css">
</head>

<body>
    <h1>Query Account</h1>
    <div>
        <p>TODO: 显示用户的(总收入和)总支出;</p>
        <p>TODO: 根据时间范围筛选，包括年、月、日;</p>

        <p>TODO: 按照年、月、日的统计情况（柱状图、折线图）;</p>
        <p>TODO: 按照类别的统计情况（饼图）;</p>
        <p>TODO: 按照消费级别的统计情况（饼图）;</p>
        
        <p>TODO: 按照时间排序;</p>
        <p>TODO: 按照金额排序;</p>
    </div>
    <div>
        <form method="GET" action="query.php">
            <!-- 筛选选项，例如按日期、类别等 -->
            <label for="date">Date:</label>
            <input type="date" id="date" name="date">
            <label for="category">Category:</label>
            <!-- 假设您有一个函数 getCategories 返回所有类别 -->
            <select id="category" name="category">
                <option value="">--Please choose an option--</option>
                <?php foreach (getCategories() as $category) : ?>
                    <option value="<?php echo $category['id']; ?>">
                        <?php echo htmlspecialchars($category['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <label for="level">Level:</label>
            <select id="level" name="level">
                <option value="">--Please choose an option--</option>
                <option value="0">正常价格</option>
                <option value="1">小奢小贵</option>
                <option value="2">大项支出</option>
            </select>
            <button type="submit">Filter</button>
        </form>
    </div>
    <div>
        <!-- 账单列表显示区域 -->
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Category</th>
                    <th>Amount</th>
                    <th>Description</th>
                    <th>Level</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($filterEntries as $entry) : ?>
                    <tr>
                        <td><?php
                            $time = new DateTime($entry['time']);
                            $formattedTime = $time->format('Y-m-d H:i');
                            echo htmlspecialchars($formattedTime);
                            ?>
                        </td>
                        <td><?php
                            $category = getCategory($entry['category_id']);
                            echo htmlspecialchars($category['name']); // 显示类别ID或名称 
                            ?>
                        </td>
                        <td><?php echo htmlspecialchars($entry['price']); ?></td>
                        <td><?php echo htmlspecialchars($entry['description'] ?? ''); ?></td>
                        <td>
                            <?php
                            if ($entry['level'] == 0) {
                                echo "正常价格";
                            } else if ($entry['level'] == 1) {
                                echo "小奢小贵";
                            } else {
                                echo "大项支出";
                            }
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>