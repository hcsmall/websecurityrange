<?php
session_start();

// 检查用户是否已登录
if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

// 处理登录表单提交
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // 进行登录验证
    // 这里需要根据您的数据库配置进行修改
    $conn = mysqli_connect('localhost', 'username', 'password', 'forum');
    if (!$conn) {
        die('数据库连接失败: ' . mysqli_connect_error());
    }

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['user'] = $username;
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['group_id'] = $row['group_id'];
            header("Location: index.php");
            exit();
        }
    }

    $error = "用户名或密码错误";

    // 关闭数据库连接
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>用户登录</title>
</head>
<body>
    <h2>用户登录</h2>
    <form method="POST" action="">
        <input type="text" name="username" placeholder="用户名" required><br><br>
        <input type="password" name="password" placeholder="密码" required><br><br>
        <input type="submit" name="login" value="登录">
    </form>
    <?php if (isset($error)) { ?>
        <p><?php echo $error; ?></p>
    <?php } ?>
    <p>还没有账号？<a href="register.php">立即注册</a></p>
</body>
</html>
