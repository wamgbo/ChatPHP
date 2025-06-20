<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css">
    <title>login</title>
</head>

<body>
    <!-- <script>
        function timeToGoToBack() {
            setTimeout(function () {
                window.location.href("login.php");
            }, 1000);
        }
    </script> -->
    <div class="container">
        <h1>帳號註冊</h1>
        <?php
        include 'db_add.php';
        include 'db_get.php';
        include 'db_connect.php';
        $email = "";
        if (!isset($_SESSION)) {
            session_start();
        }
        ?>
        <form method="POST">
            <label for="email">電子郵件:</label>
            <input type="email" id="email" name="email" required />
            <br />

            <label for="account">帳號:</label>
            <input type="text" id="account" name="account" required />
            <br />

            <label for="password">密碼:</label>
            <input type="text" id="password" name="password" required />
            <br />

            <button type="submit">註冊</button>
        </form>
        <a href="index.php">返回</a>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = isset($_POST["email"]) ? trim($_POST["email"]) : "";
            $account = isset($_POST["account"]) ? trim($_POST["account"]) : "";
            $password = isset($_POST["password"]) ? trim($_POST["password"]) : "";
            $token = bin2hex(random_bytes(32));
            // setcookie("loginToken", $token, time() + 3600, "/");
            if (in_array($email, $data_email)) {
                echo "<script>alert('信箱已註冊過');
                        document.getElementById('account').value='" . $account . "';
                        document.getElementById('password').value='" . $password . "';
                </script>";
            } elseif (in_array($account, $data_acc)) {
                echo "<script>alert('帳號已存在');
                    document.getElementById('email').value='" . $email . "';
                    document.getElementById('password').value='" . $password . "';
                    </script>";
            } else {
                insert($conn, $email, $account, $password, $token);
                echo "<script>alert('註冊成功！即將跳轉至登入頁');
                    window.location.href='index.php';
                    </script>";
            }

        }
        ?>
    </div>
</body>

</html>