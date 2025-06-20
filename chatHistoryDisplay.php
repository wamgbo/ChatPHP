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
    $friend = $_POST['friend'] ?? 'Guest';
    $data=getMessagesSend($conn,$_SESSION["account"],$friend);
    // foreach($data as $item){
    //     // echo $item.'<br>';
    // }


} else {
    echo "請使用 POST 方法";
}
?>