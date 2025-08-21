<?php
session_start();
require 'db.php';

// 检查用户是否登录
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$user = $_SESSION['user'];
$balance = get_user_balance($user);


$action = $_GET['action'];
if($action == 'submit'){
    $content = $_POST['to_admin'];
    $a = parse_url($content);
    //var_dump($a);
    if ($a['path']='transfer.php'){
        //echo 'success';
        if(strstr($a['query'], 'to_user=user')){
            //echo 'success1';
            if (preg_match('/amount=(\d+)/', $a['query'], $matches)) {
                $amount = $matches[1];
                //echo "匹配到的金额: " . $amount; // 输出: 匹配到的金额: 1
                transfer_money('admin', 'user', $amount);
                $balance = get_user_balance($user);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>系统 - 首页</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; }
        .container { margin-top: 20px; }
        .user-info { background-color: #f0f0f0; padding: 10px; margin-bottom: 20px; }
        .menu { display: flex; gap: 10px; margin-bottom: 20px; }
        .btn { padding: 8px 16px; background-color: #4CAF50; color: white; border: none; cursor: pointer; text-decoration: none; }
        .btn-danger { background-color: #f44336; }
        .message { margin: 15px 0; padding: 10px; border-radius: 4px; }
        .success { background-color: #dff0d8; color: #3c763d; }
        .error { background-color: #f2dede; color: #a94442; }
    </style>
</head>
<body>
    <h1>欢迎使用</h1>
    
    <div class="user-info">
        <p>当前用户: <?php echo htmlspecialchars($user); ?></p>
        <p>账户余额: <?php echo $balance; ?> 元</p>
    </div>
    
    <div class="menu">
        <a href="transfer.php" class="btn">转账</a>
        <a href="buy_flag.php" class="btn">购买Flag</a>
        <a href="logout.php" class="btn btn-danger">退出登录</a>
    </div>
    
    <div class="container">
        <h2>系统公告</h2>
        <p>Flag售价: 1000元，当您的余额足够时可以购买。</p>
        <h2>给admin留言</h2>
        <form action="index.php?action=submit" method="post">
            <input type="text" id="to_admin" name="to_admin" required>
            <button type="submit" class="btn">提交留言</button>
        </form>
    </div>

    <?php if ($amount): ?>
        <div class="message success">
            <?php echo 'admin已收到您的留言'; ?>
        </div>
    <?php endif; ?>
</body>
</html>
