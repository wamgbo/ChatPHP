<?php
include 'db_connect.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$database = 'C112151180';
$db_select = mysqli_select_db($conn, $database) or die("die");
global $data_acc, $data_email, $data_pass, $data_friend;
if (!isset($_SESSION)) {
    session_start();
}
function getDataAsArray($conn, $command)
{
    $res = mysqli_query($conn, $command);
    $data = [];
    $i = 0;
    while ($row_array = mysqli_fetch_row($res)) {
        foreach ($row_array as $key => $item) {
            $data[$i] = $item;
            $i++;
        }
    }
    return $data;
}
function getPasswordUseAccount($conn, $account)
{
    $command = "SELECT password FROM `user` WHERE account='$account'";
    $res = mysqli_query($conn, $command);
    $result = mysqli_fetch_assoc($res);
    return $result['password'];
}
// 取得朋友list
function getFriendList($conn, $account)
{
    global $data_acc;
    if (empty($account)) {
        return false;
    }
    if (!in_array($account, $data_acc)) {
        return false;
    }
    $command = "SELECT `friend_id` FROM `friendships` WHERE user_id='$account'";
    $res = mysqli_query($conn, $command);
    $data = [];
    $i = 0;
    while ($row_array = mysqli_fetch_row($res)) {
        foreach ($row_array as $key => $item) {
            $data[$i] = $item;
            $i++;
        }
    }
    $command = "SELECT `user_id` FROM `friendships` WHERE friend_id='$account'";
    $res = mysqli_query($conn, $command);
    while ($row_array = mysqli_fetch_row($res)) {
        foreach ($row_array as $key => $item) {
            $data[$i] = $item;
            $i++;
        }
    }
    return $data;
}
function getFriendUser($conn)
{
    global $data_acc;
    $command = "SELECT `user_id` FROM `friendships` WHERE 1";
    $res = mysqli_query($conn, $command);
    $data = [];
    $i = 0;
    while ($row_array = mysqli_fetch_row($res)) {
        foreach ($row_array as $key => $item) {
            $data[$i] = $item;
            $i++;
        }
    }
    return $data;
}

function getMessagesSend($conn, $account, $friend)
{
    $command = "SELECT `senter`,`message` FROM `message` WHERE `senter`='$account' AND `reciver` ='$friend' OR `senter`='$friend' AND `reciver` ='$account'";
    // $command = "SELECT `senter` ,`message`FROM `message` WHERE `senter`='$account' AND `reciver` ='$friend'; ";
    $res = mysqli_query($conn, $command);
    $date = date("Y-m-d H:i:s");
    $data = [];
    $i = 0;
    // while ($row_array = mysqli_fetch_assoc($res)) {
    //     $data = [$row_array['senter']] = $row_array['message'];
    //     foreach ($row_array as $key => $item) {
    //         echo $key . ":" . $item . "<br>";
    //         // $data[$i] = $item;
    //         // $i++;
    //     }
    // }
    while ($row = mysqli_fetch_assoc($res)) {
        // echo "sender: " . $row['senter'] . "<br>";
        // echo "message: " . $row['message'] . "<br>";
        echo $row['senter'].": ".$row['message']."<br>";
    }

    return $data;
}
$account = isset($_SESSION["account"]) ? $_SESSION["account"] : null;
$data_acc = getDataAsArray($conn, "SELECT account FROM user");
$data_pass = getDataAsArray($conn, "SELECT password FROM user");
$data_email = getDataAsArray($conn, "SELECT email FROM user");
$data_friend = getFriendList($conn, $account);
$data_friend_user = getFriendUser($conn);
mysqli_query($conn, "SET CHARACTER SET 'utf8'");
mysqli_query($conn, "SET NAMES 'utf8'");
?>