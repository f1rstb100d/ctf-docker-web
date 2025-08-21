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
$message = '';
$flag = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Flag价格为1000元
    $flag_price = 1000;
    
    if ($balance >= $flag_price) {
        // 扣减金额并获取flag
        if (deduct_money($user, $flag_price)) {
            $message = '购买成功！';
            $flag = get_flag();
            $balance = get_user_balance($user); // 更新余额显示
        } else {
            $message = '购买失败，请重试';
        }
    } else {
        $message = '余额不足，无法购买Flag (需要1000元)';
    }
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>银行系统 - 购买Flag</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        .btn { padding: 10px 16px; background-color: #4CAF50; color: white; border: none; cursor: pointer; }
        .back { display: inline-block; margin-top: 15px; color: #0066cc; text-decoration: none; }
        .message { margin: 15px 0; padding: 10px; border-radius: 4px; }
        .success { background-color: #dff0d8; color: #3c763d; }
        .error { background-color: #f2dede; color: #a94442; }
        .flag { margin: 15px 0; padding: 15px; background-color: #f8f9fa; border-radius: 4px; font-family: monospace; }
    </style>
</head>
<body>
    <h1>购买Flag</h1>
    <p>当前余额: <?php echo $balance; ?> 元</p>
    <p>Flag价格: 1000元</p>
    
    <?php if ($message): ?>
        <div class="message <?php echo strpos($message, '成功') !== false ? 'success' : 'error'; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    
    <?php if ($flag): ?>
        <div class="flag">
            Flag: <?php echo $flag; ?>
        </div>
    <?php endif; ?>
    
    <form method="post">
        <button type="submit" class="btn">购买Flag</button>
    </form>
    
    <a href="index.php" class="back">返回首页</a>
</body>
</html>
