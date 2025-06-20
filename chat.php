<!-- 超簡單 tes2.php -->
<?php
include 'db_connect.php';
include 'db_add.php';
include 'db_get.php';
// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Methods: POST');
// header('Access-Control-Allow-Headers: Content-Type');
if (!isset($_SESSION)) {
    session_start();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = $_POST['message'] ?? 'Guest';
    $friend = $_POST['friend'] ?? 'Guest';
    sentMassage($conn, $_SESSION["account"], $friend, $message);
    echo $_SESSION["account"].": ". $message;
    // echo $message . "!";
    // echo $_SESSION["account"] . " ";
    // echo $date = date("Y-m-d H:i:s");
    // echo $friend . "!";


} else {
    echo "請使用 POST 方法";
}
?>