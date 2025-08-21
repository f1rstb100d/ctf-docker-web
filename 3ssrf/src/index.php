<?php
error_reporting(0);
highlight_file(__FILE__);
if (!isset($_REQUEST['url'])){
    header("Location: /?url=1.txt");
    exit;
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $_REQUEST['url']);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_exec($ch);  //flag in /flag
curl_close($ch);

echo ($result);
?>
