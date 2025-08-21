<?php require 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>用户登录 - CTF挑战系统</title>
    <link rel="stylesheet" href="css2.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>欢迎回来</h2>
        </div>
        <div class="card-body">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $username = $_POST['username'];
                $password = $_POST['password'];
                
                $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? AND password = ?");
                $stmt->execute([$username, $password]);
                $user = $stmt->fetch();
                
                if ($user) {
                    $_SESSION['userid'] = $user['id'];
                    header("Location: profile.php?userid=" . $user['id']);
                    exit();
                } else {
                    echo '<div class="alert alert-error">用户名或密码错误！</div>';
                }
            }
            ?>
            <form method="POST">
                <div class="form-group">
                    <label for="username">用户名</label>
                    <input type="text" class="form-control" name="username" required placeholder="请输入用户名">
                </div>
                <div class="form-group">
                    <label for="password">密码</label>
                    <input type="password" class="form-control" name="password" required placeholder="请输入密码">
                </div>
                <button type="submit" class="btn btn-primary">登录账户</button>
            </form>
            
            <div class="text-center mt-4">
                <p>还没有账号？</p>
                <button class="btn btn-secondary" onclick="window.location.href='register.php'">创建新账户</button>
            </div>
        </div>
    </div>
    
</div>
</body>
</html>