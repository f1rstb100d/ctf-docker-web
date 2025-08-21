<?php
session_start();
require 'db.php';

// 如果用户已登录，跳转到首页
if (isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (check_credentials($username, $password)) {
        $_SESSION['user'] = $username;
        header('Location: index.php');
        exit;
    } else {
        $error = '用户名或密码错误';
    }
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>系统 - 登录</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 400px; margin: 0 auto; padding: 20px; }
        .login-form { margin-top: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input { width: 100%; padding: 8px; box-sizing: border-box; }
        .btn { width: 100%; padding: 10px; background-color: #4CAF50; color: white; border: none; cursor: pointer; }
        .error { color: red; margin-bottom: 15px; }
    </style>
</head>
<body>
    <h1>系统登录</h1>
    
    <?php if ($error): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <form class="login-form" method="post">
        <div class="form-group">
            <label for="username">用户名</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">密码</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" class="btn">登录</button>
    </form>
    
    <p>测试账号: user / password</p>
</body>
</html>
