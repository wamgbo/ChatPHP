<?php
header("Content-Type:text/html; charset=utf-8");
$host='127.0.0.1';
$admin_name='root';
// $admin_password='STUC112151180!@#';
$database='C112151180';
$conn=mysqli_connect($host,$admin_name,"",$database) or die("連線失敗");
mysqli_query($conn,"SET CHARACTER SET 'utf8'");
mysqli_query($conn,"SET NAMES 'utf8'");
// if($conn)
//     echo "連線成功";
// else
//     echo "連線失敗";
// echo "<br>"
?>