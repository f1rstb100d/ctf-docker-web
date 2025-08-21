<?php require 'config.php'; 

if (empty($_SESSION['userid'])) {
    header("Location: index.php");
    exit();
}

$requested_id = isset($_GET['userid']) ? (int)$_GET['userid'] : $_SESSION['userid'];

try {
    $stmt = $pdo->prepare("SELECT username, profile FROM users WHERE id = ?");
    $stmt->execute([$requested_id]);
    $user = $stmt->fetch();
} catch (PDOException $e) {
    die('<div class="alert alert-error">资料加载失败</div>');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>个人资料 - CTF挑战系统</title>
    <link rel="stylesheet" href="css2.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container profile-container">
    <div class="profile-box">
        <div class="profile-header">
            <h2>用户资料</h2>
        </div>
        
        <?php if ($user): ?>
            <div>
                <p><strong>用户ID:</strong> <?= $requested_id ?></p>
                <p><strong>用户名:</strong> <?= htmlspecialchars($user['username']) ?></p>
            </div>
            
            <div class="mt-4">
                <h3>个人简介</h3>
                <div class="profile-content">
                    <?= nl2br(htmlspecialchars($user['profile'])) ?>
                </div>
            </div>
            
            <?php if ($requested_id == 1): ?>
                <div class="mt-4">
                    <div class="alert alert-success">
                        <strong>管理员提示:</strong> 此账户包含敏感信息，请妥善保管您的登录凭据
                    </div>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="alert alert-error">用户不存在!</div>
        <?php endif; ?>
        
        <div class="links mt-4">
            <a href="profile.php?userid=<?= $_SESSION['userid'] ?>">查看我的资料</a>
            <a href="index.php">返回首页</a>
            <a href="#" onclick="event.preventDefault(); if(confirm('确定要退出登录吗？')) { window.location = 'index.php?logout'; }">退出登录</a>
        </div>
    </div>
    
    <div class="text-center mt-4">
        <p>F1rstb100d &copy; 2025</p>
    </div>
</div>
</body>
</html>