<!DOCTYPE html>
<html>
<head>
    <title>管理员登录</title>
</head>
<body>
    <h1>管理员登录</h1>
    <form action="index.php" method="POST">
        用户名: <input type="text" name="username"><br>
        密码: <input type="password" name="password"><br>
        <input type="submit" value="登录">
    </form>
</body>
</html>

<?php
$flag = getenv('GZCTF_FLAG'); // 从环境变量获取flag

// 数据库配置
$host = 'localhost';
$dbname = 'web';
$user = 'root';
$pass = 'root';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $username = $_POST['username'];
    $password = $_POST['password'];

    // 存在SQL注入漏洞的查询
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    echo $sql;
    $stmt = $pdo->query($sql);
    
    if ($stmt->rowCount() > 0) {
        echo "登录成功！FLAG: " . $flag;
    } else {
        echo "登录失败！";
    }
} catch (PDOException $e) {
    die("数据库错误: " . $e->getMessage());
}
?>