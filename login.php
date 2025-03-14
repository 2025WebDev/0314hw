<?php

require_once("./core/api.php");

$LOGIN_SUCCESSFUL = true;

if ($_SERVER["REQUEST_METHOD"] == "POST" &&
    isset($_POST["username"]) &&
    isset($_POST["password"]))
{
    $LOGIN_SUCCESSFUL = logIn($_POST["username"], $_POST["password"]);
    if ($LOGIN_SUCCESSFUL)
    {
        $NICKNAME = getNickname(NULL);
        $ROLE = roleIdToChineseStr(getUserRoleId());
        echo "<script>alert(\"$ROLE $NICKNAME 您好！\");location.replace(\"index.php\");</script>";
        exit();
    }
    else
    {
        echo "<script>alert(\"帳密錯誤！\");</script>";
    }
}

?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>登入畫面</title>
</head>
<body bgcolor="#4ACAD5">
<font face="微軟正黑體">
<?php renderHeader(); ?>
<h1>登入</h1>
<form id="loginForm" method="POST" onsubmit="return checkSubmission();">
    <label for="username">帳號：</label>
    <input type="text" id="username" name="username" placeholder="請輸入帳號" value="<?php echo $_COOKIE['username'] ?? ''; ?>" required><br/>
    <label for="password">密碼：</label>
    <input type="password" id="password" name="password" placeholder="請輸入密碼" required>
    <input type="submit" value="登入" class="btn"><br/><br/>
</form>
</font>
</body>
</html>