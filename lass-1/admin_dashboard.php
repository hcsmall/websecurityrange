<?php
session_start();

// 检查管理员是否已登录
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

// 处理注销请求
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: admin_login.php");
    exit();
}

// 处理用户管理、用户组划分、用户封号等功能
// ...

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>管理员后台</title>
</head>
<body>
    <h2>管理员后台</h2>
    <p>欢迎，<?php echo $_SESSION['admin']; ?></p>
    <a href="?logout">注销</a>
    <h3>用户管理</h3>
    <!-- 用户管理功能表单 -->
    <h3>用户组划分</h3>
    <!-- 用户组划分功能表单 -->
    <h3>用户封号</h3>
    <!-- 用户封号功能表单 -->
    <h3>邀请码生成</h3>
    <!-- 邀请码生成功能表单 -->
</body>
</html>
