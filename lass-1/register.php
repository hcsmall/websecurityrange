<?php
session_start();

// 检查用户是否已登录
if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

// 处理注册表单提交
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // 对密码进行加密处理
    $password = password_hash($password, PASSWORD_DEFAULT);

    // 插入用户到数据库
    // 这里需要根据您的数据库配置进行修改
    $conn = mysqli_connect('localhost', 'username', 'password', 'forum');
    if (!$conn) {
        die('数据库连接失败: ' . mysqli_connect_error());
    }

    $group_id = 1; // 默认用户组ID

    $sql = "INSERT INTO users (username, password, email, group_id) VALUES ('$username', '$password', '$email', '$group_id')";
    mysqli_query($conn, $sql);

    // 关闭数据库连接
    mysqli_close($conn);

    // 注册成功后，自动登录并跳转到论坛首页
    $_SESSION['user'] = $username;
    $_SESSION['group_id'] = $group_id;
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>用户注册</title>
</head>
<body>
    <h2>用户注册</h2>
    <form method="POST" action="">
        <input type="text" name="username" placeholder="用户名" required><br><br>
        <input type="password" name="password" placeholder="密码" required><br><br>
        <input type="email" name="email" placeholder="邮箱" required><br><br>
        <input type="submit" name="register" value="注册">
    </form>
</body>
</html>
