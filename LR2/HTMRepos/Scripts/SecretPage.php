<?php
require_once ("logic.php");

if(!empty($_SESSION["username"]))
{
    header("Location: Orders.php");
}
else
{
    header("Location: Authorization.php");
}
exit();
