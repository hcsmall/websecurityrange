<?php
session_start();

// 检查用户是否已登录
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// 处理注销请求
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

// 处理发帖功能
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    // 插入帖子到数据库
    // 这里需要根据您的数据库配置进行修改
    $conn = mysqli_connect('localhost', 'username', 'password', 'forum');
    if (!$conn) {
        die('数据库连接失败: ' . mysqli_connect_error());
    }

    $user_id = $_SESSION['user_id'];
    $group_id = $_SESSION['group_id'];

    $sql = "INSERT INTO posts (user_id, group_id, title, content) VALUES ('$user_id', '$group_id', '$title', '$content')";
    mysqli_query($conn, $sql);

    // 关闭数据库连接
    mysqli_close($conn);

    // 返回到论坛首页
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>论坛首页</title>
</head>
<body>
    <h2>论坛首页</h2>
    <p>欢迎，<?php echo $_SESSION['user']; ?></p>
    <a href="?logout">注销</a>
    <h3>发帖</h3>
    <form method="POST" action="">
        <input type="text" name="title" placeholder="标题" required><br><br>
        <textarea name="content" placeholder="内容" required></textarea><br><br>
        <input type="submit" name="submit" value="发帖">
    </form>
    <h3>帖子列表</h3>
    <?php
    // 从数据库获取帖子列表
    // 这里需要根据您的数据库配置进行修改
    $conn = mysqli_connect('localhost', 'username', 'password', 'forum');
    if (!$conn) {
        die('数据库连接失败: ' . mysqli_connect_error());
    }

    $sql = "SELECT * FROM posts";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<h4>{$row['title']}</h4>";
        echo "<p>{$row['content']}</p>";
        echo "<hr>";
    }

    // 关闭数据库连接
    mysqli_close($conn);
    ?>
</body>
</html>
