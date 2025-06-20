<?php
// include 'dashboard.php';
include 'db_connect.php';
include 'db_get.php';
include 'db_add.php';
if (!isset($_SESSION)) {
    session_start();
}
$account = isset($_POST["account"]) ? $_POST["account"] : "";
$password = isset($_POST["password"]) ? $_POST["password"] : "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (in_array($account, $data_acc) && $password != getPasswordUseAccount($conn, $account)) {
        include "index.php";
        echo "<script>
                        document.getElementById('account').value='" . $account . "';
                </script>";
        echo '<div id="reminder"color="red">密碼錯誤</di>';

    } elseif (!in_array($account, $data_acc)) {
        include "index.php";
        echo '<div color="red">帳號不存在</di>';

    } elseif (in_array($account, $data_acc) && in_array($password, $data_pass)) {
        $token = bin2hex(random_bytes(32));
        updateToken($conn, $account, $token);
        $_SESSION["account"] = $account;
        setcookie("loginToken", $token, time() + 3600*24*7, "/");
        header('Location:dashboard.php');
    }
}
?>