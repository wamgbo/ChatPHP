<?php
// include 'db_get.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION)) {
    session_start();
}
function removeFriend($conn, $account, $friend)
{
    global $data_acc;
    global $data_friend;
    global $data_friend_user;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // 1. 自己不能加自己
        if ($account == $friend) {
            echo "你不刪除自己";
            return;
        }
        // 2. 檢查 friend 是否存在於 users 表
        if (!in_array($friend, $data_acc)) {
            echo "此用戶不存在";
            return;
        }
        // 3. 檢查是否已經是好友
        if (!in_array($friend, $data_friend)) {
            echo "你們不是好友";
            return;
        }
        // 4. 插入好友資料（單向）
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $sql="DELETE FROM `friendships` WHERE  `friend_id`= '$friend' AND `user_id`='$account'
            OR `friend_id`= '$account' AND `user_id`='$friend'";
            // echo "SQL 語句: $sql<br>";
            if (mysqli_query($conn, $sql))
                echo '<h3 style="color: blue; "align="center">刪除成功</a>';
            else
                echo "註冊失敗:" . mysqli_error($conn);
            header("Location:dashboard.php");
        }
    }
}

?>