<?php
$db_host = "localhost";
$db_user = "root";
$db_pass = "root";
$db_name = "web";
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
if ($conn->connect_error) {
    die("connect error: " . mysqli_connect_error());
}

// 检查用户名和密码
function check_credentials($username, $password) {
    global $conn;
    
    $stmt = $conn->prepare("SELECT COUNT(*) AS valid FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    $stmt->close();
    return $row['valid'] > 0;
}

// 检查用户是否存在
function user_exists($username) {
    global $conn;
    
    $stmt = $conn->prepare("SELECT COUNT(*) AS exists_flag FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    $stmt->close();
    return $row['exists_flag'] > 0;
}

// 获取用户余额
function get_user_balance($username) {
    global $conn;
    
    $stmt = $conn->prepare("SELECT balance FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stmt->close();
        return $row['balance'];
    }
    
    $stmt->close();
    return 0;
}

// 转账操作
function transfer_money($from_user, $to_user, $amount) {
    global $conn;
    
    // 开始事务
    $conn->begin_transaction();
    
    try {
        // 检查转出账户
        $stmt1 = $conn->prepare("SELECT balance FROM users WHERE username = ? FOR UPDATE");
        $stmt1->bind_param("s", $from_user);
        $stmt1->execute();
        $result1 = $stmt1->get_result();
        
        if ($result1->num_rows == 0) {
            throw new Exception("转出账户不存在");
        }
        $balance = $result1->fetch_assoc()['balance'];
        $stmt1->close();
        
        // 检查余额
        if ($balance < $amount) {
            throw new Exception("余额不足");
        }
        
        // 检查转入账户
        $stmt2 = $conn->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
        $stmt2->bind_param("s", $to_user);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        
        if ($result2->fetch_row()[0] == 0) {
            throw new Exception("转入账户不存在");
        }
        $stmt2->close();
        
        // 扣除金额
        $stmt3 = $conn->prepare("UPDATE users SET balance = balance - ? WHERE username = ?");
        $stmt3->bind_param("ds", $amount, $from_user);
        $stmt3->execute();
        
        if ($stmt3->affected_rows == 0) {
            throw new Exception("扣除金额失败");
        }
        $stmt3->close();
        
        // 增加金额
        $stmt4 = $conn->prepare("UPDATE users SET balance = balance + ? WHERE username = ?");
        $stmt4->bind_param("ds", $amount, $to_user);
        $stmt4->execute();
        
        if ($stmt4->affected_rows == 0) {
            throw new Exception("增加金额失败");
        }
        $stmt4->close();
        
        // 提交事务
        $conn->commit();
        return true;
    } catch (Exception $e) {
        // 回滚事务
        $conn->rollback();
        error_log("转账失败: " . $e->getMessage());
        return false;
    }
}

// 扣减金额
function deduct_money($user, $amount) {
    global $conn;
    
    $stmt = $conn->prepare("UPDATE users SET balance = balance - ? WHERE username = ? AND balance >= ?");
    $stmt->bind_param("dsd", $amount, $user, $amount);
    $stmt->execute();
    
    $success = $stmt->affected_rows > 0;
    $stmt->close();
    
    return $success;
}

// 获取Flag
function get_flag() {
    $flag_content = file_get_contents('/flag');
    //return 'flag{csrf_vu1n_1s_d4ng3r0us}';
    return $flag_content;
}
?>
