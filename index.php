<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css">
    <title>login</title>
</head>

<body>
    <div class="container">
        <h1>登入系統</h1>
        <?php
        if (!isset($_SESSION)) {
            session_start();
        }

        if (isset($_COOKIE["loginToken"])) {
            $date=date("Y-m-d H:i:s");
            echo $date;
            echo '<br>你已今登入<br>';
            echo '<a href="dashboard.php"> <button>首頁</button></a>';
        } else {
            echo '<form id="loginForm" action="login.php" method="POST">
            <label for="account">帳號:</label>
            <input type="text" id="account" name="account" />
            <br />
            <label for="password">密碼:</label>
            <input type="text" id="password" name="password" />
            <br>
            <button type="submit">登入</button>
            </form>
            <a href="register.php">註冊</a>
            ';
        }
        ?>
    </div>
    <!-- <script>
        document.getElementById("loginForm").addEventListener("submit", function (e) {
            const acc = document.getElementById("account").value.trim();
            const pwd = document.getElementById("password").value.trim();
            if (acc === "" || pwd === "") {
                alert("帳號和密碼都不能空白！");
                e.preventDefault(); // 阻止表單送出
            }
        });
    </script> -->
</body>

</html>