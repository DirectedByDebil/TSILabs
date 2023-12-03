<?php
require_once("../.core/logic.php");

if(!empty($_SESSION["username"]))
{
    header("Location: ../Pages/Orders.php");
}
else
{
    header("Location: ../Pages/Authorization.php");
}
exit();
