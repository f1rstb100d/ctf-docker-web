<?php
    if(isset($_GET['ip'])){
        $ip = $_GET['ip'];
        echo shell_exec("ping - c 4 " . $ip);
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ping一下</title>
</head>
<body>
<h1>Ping一下试试呢</h1>
<form method="GET">
    <label for="ip">IP： </label>
    <input type="text" id="ip" name="ip">
    <input type="submit" value="submit">
</form>
<?php
echo "执行命令:  ping - c 4 " . $_GET['ip'];
?>
</body>
</html>