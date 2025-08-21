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

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $to_user = $_GET['to_user'] ?? '';
    $amount = $_GET['amount'] ?? 0;
    
    // 验证金额是否为正数
    if ($amount <= 0 || !is_numeric($amount)) {
        $message = '请输入有效的转账金额';
    } 
    // 验证目标用户是否存在
    elseif (!user_exists($to_user)) {
        $message = '目标用户不存在';
    }
    // 验证余额是否充足
    elseif ($balance < $amount) {
        $message = '余额不足';
    }
    // 执行转账
    else {
        if (transfer_money($user, $to_user, $amount)) {
            $message = '转账成功';
            $balance = get_user_balance($user); // 更新余额显示
        } else {
            $message = '转账失败，请重试';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>系统 - 转账</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input { width: 100%; padding: 8px; box-sizing: border-box; }
        .btn { padding: 10px 16px; background-color: #4CAF50; color: white; border: none; cursor: pointer; }
        .back { display: inline-block; margin-top: 15px; color: #0066cc; text-decoration: none; }
        .message { margin: 15px 0; padding: 10px; border-radius: 4px; }
        .success { background-color: #dff0d8; color: #3c763d; }
        .error { background-color: #f2dede; color: #a94442; }
    </style>
</head>
<body>
    <h1>转账</h1>
    <p>当前余额: <?php echo $balance; ?> 元</p>
    
    <?php if ($message): ?>
        <div class="message <?php echo strpos($message, '成功') !== false ? 'success' : 'error'; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    
    <form method="get">
        <div class="form-group">
            <label for="to_user">目标用户名</label>
            <input type="text" id="to_user" name="to_user" required>
        </div>
        <div class="form-group">
            <label for="amount">转账金额 (元)</label>
            <input type="number" id="amount" name="amount" min="1" step="1" required>
        </div>
        <button type="submit" class="btn">确认转账</button>
    </form>
    
    <a href="index.php" class="back">返回首页</a>
</body>
</html>
