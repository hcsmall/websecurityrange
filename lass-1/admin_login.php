<?php
session_start();

// 检查管理员是否已登录
if (isset($_SESSION['admin'])) {
    header("Location: admin_dashboard.php");
    exit();
}

// 处理登录表单提交
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // 进行登录验证
    // 这里需要根据您的管理员账号和密码进行修改
    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['admin'] = $username;
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $error = "用户名或密码错误";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>管理员登录</title>
</head>
<body>
    <h2>管理员登录</h2>
    <form method="POST" action="">
        <input type="text" name="username" placeholder="用户名" required><br><br>
        <input type="password" name="password" placeholder="密码" required><br><br>
        <input type="submit" name="login" value="登录">
    </form>
    <?php if (isset($error)) { ?>
        <p><?php echo $error; ?></p>
    <?php } ?>
</body>
</html>
