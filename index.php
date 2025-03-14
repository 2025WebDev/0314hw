<?php

require_once("core/api.php");

if (!isLoggedIn())
{
    header("Location: login.php");
    exit();
}

switch (getUserRoleId())
{
    case 0:
        header("Location: form.php");
        break;
    case 1:
        header("Location: admin.php");
        break;
}

?>