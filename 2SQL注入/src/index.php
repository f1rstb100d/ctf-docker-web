<!DOCTYPE html>
<html>
<head>
    <title>新闻阅读器</title>
</head>
<body>
    <h1>输入新闻id进行阅读</h1>
    <form action="index.php" method="POST">
        新闻id: <input type="text" name="newsid"><br>
        <input type="submit" value="查询">
    </form>
</body>
</html>

<?php

$db_host = "localhost";
$db_user = "root";
$db_pass = "root";
$db_name = "web";
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) {
    die("connect error: " . mysqli_connect_error());
}
$newsid = $_POST['newsid'];

$sql = "select * from news where id=$newsid;";
echo $sql;
echo "</br>";
$result = mysqli_query($conn, $sql);
$res    = mysqli_fetch_array($result);
//var_dump($result);
echo $res['data'];
mysqli_close($conn);
//phpinfo();
?>