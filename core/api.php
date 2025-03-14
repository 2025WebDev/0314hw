<?php

session_start();

$USER_DATA = array(
                   array(
                         "nickname" => "測試者1",
                         "username" => "test1",
                         "password" => "test1",
                         "role" => 0),
                   array(
                         "nickname" => "測試者2",
                         "username" => "test2",
                         "password" => "test2",
                         "role" => 1)
);

function isLoggedIn($role_id = NULL)
{
    return isset($_SESSION["UserID"]) && ($role_id === NULL || $role_id === $_SESSION["Role"]);
}

function askForLogin($role_id = NULL)
{
    if (!isLoggedIn($role_id))
    {
        logOut();
        echo "<script>alert(\"您尚未登入，無法存取本頁面！\"); location.replace(\"login.php\");</script>";
        exit();
    }
}

function getUsername()
{
    if (!isLoggedIn())
        return "";
    global $USER_DATA;
    return $USER_DATA[$_SESSION["UserID"]]["username"];
}

function getNickname($id = NULL)
{
    if ($id === NULL && !isLoggedIn())
        return "訪客";
    global $USER_DATA;
    return $USER_DATA[$id ?? $_SESSION["UserID"]]["nickname"];
}

function getUserRoleId()
{
    if (!isLoggedIn())
        return -1;
    global $USER_DATA;
    return $USER_DATA[$_SESSION["UserID"]]["role"];
}

function roleIdToChineseStr($role_id)
{
    switch ($role_id)
    {
        case 1:
            return "管理者";
        case 0:
            return "一般用戶";
        default:
            return "未登入";
      }
}

function getHeaderMenuForRole($role_id): array
{
    switch ($role_id)
    {
        case 0:
            return array("填寫資料" => "form.php");
        case 1:
            return array("填寫資料" => "form.php",
                         "管理資料" => "admin.php");
    }
}

function renderHeader()
{
    $NICKNAME = getNickname(NULL);
    $ROLE = roleIdToChineseStr(getUserRoleId());
    echo "$ROLE $NICKNAME 您好！";
    if (isLoggedIn())
    {
        echo "<a href=\"logout.php\"><button>登出</button></a>";
        $options = getHeaderMenuForRole(getUserRoleId());
        foreach ($options as $key=>$value) {
            echo "　<a href=\"$value\"><button>$key</button></a>\n";
        }
    }
    else
    {
        echo "<a href=\"login.php\"><button>登入</button></a>";
    }

    $date = date("Y/m/d H:i:s");
    $last_date = date("Y/m/d H:i:s", $_COOKIE["last_time"] ?? time());
    echo "<br>上次瀏覽：$last_date<br>現在時間：$date<br><br>";
    setcookie("last_time", time(), 0, "/");
}

function logOut()
{
    setcookie("username", getUsername(), strtotime("+10 seconds"), "/");
    session_unset();
    //session_destroy();
}

function logIn($username, $password)
{
    logOut(); // always 先登出再登入
    global $USER_DATA;
    $ACCOUNT_COUNT = count($USER_DATA);
    for ($i = 0; $i < $ACCOUNT_COUNT; $i++)
    {
        if ($username == $USER_DATA[$i]["username"] && /*hash("sha256", $password)*/ $password == $USER_DATA[$i]["password"])
        {
            $_SESSION["UserID"] = $i;
            $_SESSION["Role"] = $USER_DATA[$i]["role"];
            return true;
        }
    }
    return false;
}

?>