<?php
include 'db_connect.php';
include 'db_get.php';
// include 'login.php';
include 'db_add.php';
// 首頁
if (!isset($_SESSION)) {
    session_start();
}
$frontPage = isset($_POST["frontPage"]) ? $_POST["frontPage"] : null;
if (isset($frontPage)) {
    header("Location:index.php");
}
// 登出
$logout = isset($_POST["logout"]) ? $_POST["logout"] : null;
if (isset($logout)) {
    unset($_SESSION["account"]);
    setcookie("loginToken", $token, time() - 0, "/");
    header("Location:index.php");
}
// 新增朋友
$friend = isset($_POST["friend"]) ? $_POST["friend"] : null;
if (isset($_POST["addFriend"])) {
    if (isset($friend)) {
        addFriend($conn, $_SESSION["account"], $friend);
    }
}

$message = isset($_POST["message"]) ? $_POST["message"] : null;
if (isset($message)) {
    sentMassage($conn, $_SESSION["account"], "admin", $message);
}
echo '<h1>歡迎' . $_SESSION["account"] . '!</h1>';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>dashboard</title>
    <style>
        #chat-box {
            border: 5px solid #ccc;
            height: 300px;
            /* width: 200px; */
            overflow-y: auto;
            padding: 10px;
            margin-bottom: 10px;
            text-align: left;
        }

        #message {
            float: left;
            border: 5px solid #ccc;
            width: 1700px;
            overflow-y: auto;
            padding: 10px;
            margin-bottom: 10px;
            text-align: left;
        }
    </style>
</head>

<body>
    <!--新增朋友欄-->
    <form method="post">
        <input type="text" name="friend" id="friend" required>
        <button type="submit" name="addFriend">新增</button>
    </form>
    <!--選擇朋友欄-->
    <label for="friend_select">選擇朋友：</label>
    <select name="friend_select" id="friend_select" onchange="displayHistor()">
        <option value="">-- 請選擇 --</option>
        <?php
        foreach ($data_friend as $item) {
            echo "<option value=\"$item\">$item</option>";
        }
        ?>
    </select>
    <button id="remove" onclick="removeFriend()">刪除</button>
    <br>
    </label>
    <p id="result"></p>
    <!-- Chat -->
    <h3>聊天室 </h3>
    <div id="chat-box"></div>
    <input type="text" id="message" name="message" placeholder="輸入訊息" onkeydown="handleEnther()">
    <button type="submit" onclick="send()" id="send-button">發送</button>

    <form action="dashboard.php" method="POST">
        <button type="submit" name="logout">登出</button>
        <button type="submit" name="frontPage">首頁</button>
    </form>
<!--  -->
    <script>
        let updateInterval = null;
        function handleEnther(){
            if(event.keyCode==13){
                send();
            }
        }
        async function removeFriend() {
            const friend_select = document.getElementById('friend_select').value;
            const response = await fetch('removeFriend.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'message=' + message + '&friend=' + friend_select
            });
            await window.location.reload();


        }//  
        async function send() {
            const message = document.getElementById('message').value;
            const friend_select = document.getElementById('friend_select').value;

            const response = await fetch('chat.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'message=' + message + '&friend=' + friend_select
            });
            const text = await response.text();
            const result = document.getElementById('chat-box');
            result.innerHTML += text + '<br>';
            document.getElementById('message').value = "";
        }//  
        async function displayHistor() {
            const friend_select = document.getElementById('friend_select').value;

            const response = await fetch('chatHistoryDisplay.php ', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'friend=' + friend_select
            });
            const text = await response.text();
            const result = document.getElementById('chat-box');
            result.innerHTML = text;
            // document.getElementById('message').value = "";
        }
        document.getElementById('friend_select').addEventListener('change', function () {
            // 清除之前的定時器
            if (updateInterval) {
                clearInterval(updateInterval);
            }

            // 如果有選擇朋友，開始自動更新
            if (this.value) {
                displayHistor(); // 立即執行一次
                updateInterval = setInterval(displayHistor, 1000); // 每秒更新
            }
        });
    </script>
</body>

</html>