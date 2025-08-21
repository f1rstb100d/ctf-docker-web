<?php
error_reporting(0);
session_start();

// 生成随机目录名防止直接扫描
$secret_dir = "files_" . bin2hex(random_bytes(6));
if (!isset($_SESSION['data_dir'])) {
    $_SESSION['data_dir'] = $secret_dir;
    mkdir($_SESSION['data_dir']);
    file_put_contents("{$_SESSION['data_dir']}/readme.txt", "仅供下载的合法文件，flag在/flag里");
}

// 用户可控的下载参数
$file = $_GET['file'] ?? '';

if (!empty($file)) {
    $base_dir = realpath($_SESSION['data_dir']) . DIRECTORY_SEPARATOR;
    $user_path = $base_dir . $file;
    
    // 模拟漏洞：未过滤路径穿越符号
    if (file_exists($user_path)) {
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($file).'"');
        readfile($user_path);
        exit;
    } else {
        die("文件不存在！");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>文件下载中心</title>
</head>
<body>
    <h1>文件下载服务</h1>
    <p>输入文件名下载（示例：<code>readme.txt</code>）</p>
    <form method="GET">
        <input type="text" name="file" placeholder="文件名" required>
        <input type="submit" value="下载">
    </form>
    <!-- 提示：合法文件存储在临时目录中 -->
</body>
</html>