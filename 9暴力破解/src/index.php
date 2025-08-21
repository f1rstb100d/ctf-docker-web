<?php
//session_start();
$db_host = 'localhost';
$db_name = 'web';
$db_user = 'root';
$db_pass = 'root';

$error = '';
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    try {
        $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // 查询用户是否存在
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$user) {
            $error = "用户不存在";
        } else {
            // 验证密码
            if ($password === $user['password']) {
                //$_SESSION['user'] = $username;
                // 目标账户登录成功显示flag
                if ($username === 'admin') {
                    
                    $flag = getenv('GZCTF_FLAG');
                    global $flag;
                    $message = "登录成功! Flag: $flag";
                } else {
                    $message = "登录成功! 但你不是目标用户";
                }
            } else {
                $error = "密码错误";
            }
        }
    } catch (PDOException $e) {
        $error = "数据库错误";
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>CTF登录挑战</title>
    <style>
        body { font-family: sans-serif; max-width: 500px; margin: 2rem auto; }
        .container { padding: 2rem; border: 1px solid #ddd; border-radius: 5px; }
        .error { color: red; margin: 10px 0; }
        .success { color: green; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <h1>管理员登录系统</h1>
        <?php if (!empty($message)): ?>
            <div class="success"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div>
                <label>用户名:</label>
                <input type="text" name="username" required>
            </div>
            <div>
                <label>密码:</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit">登录</button>
        </form>
        
        <?php if (!empty($error)): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        
        <div style="margin-top: 20px; font-size: 0.9em; color: #666;">
            <strong>提示:</strong> 密码为4位数字
        </div>
    </div>
</body>
</html>