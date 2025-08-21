<?php require 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>用户注册 - CTF挑战系统</title>
    <link rel="stylesheet" href="css2.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>创建账户</h2>
        </div>
        <div class="card-body">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $profile = $_POST['profile'];
                
                try {
                    $stmt = $pdo->prepare("INSERT INTO users (username, password, profile) VALUES (?, ?, ?)");
                    $stmt->execute([$username, $password, $profile]);
                    
                    $user_id = $pdo->lastInsertId();
                    echo '<div class="alert alert-success">';
                    echo "<p>注册成功！</p>";
                    echo "<p>请妥善保存您的凭证信息</p>";
                    echo '<p class="mt-3"><a href="index.php" class="btn btn-light">前往登录</a></p>';
                    echo '</div>';
                } catch (PDOException $e) {
                    echo '<div class="alert alert-error">错误：用户名已被使用，请选择其他用户名</div>';
                }
            }
            
            if (!isset($_POST['username']) || (isset($_POST['username']) && !empty($e))):
            ?>
            <form method="POST">
                <div class="form-group">
                    <label for="username">用户名</label>
                    <input type="text" class="form-control" name="username" required placeholder="设置您的用户名">
                </div>
                <div class="form-group">
                    <label for="password">密码</label>
                    <input type="password" class="form-control" name="password" required placeholder="设置您的密码">
                </div>
                <div class="form-group">
                    <label for="profile">个人简介</label>
                    <textarea class="form-control" name="profile" required placeholder="介绍一下你自己..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary">注册账户</button>
            </form>
            <?php endif; ?>
        </div>
    </div>
    
    <div class="text-center">
        <a href="index.php">返回登录页面</a>
    </div>
</div>
</body>
</html>