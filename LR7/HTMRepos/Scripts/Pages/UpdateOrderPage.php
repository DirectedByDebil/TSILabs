<?php
require_once ("../.core/logic.php");
include ("../.core/SushiHeader.php");
?>

<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name = "description" content="Изменить заказ">
    <title>Изменить заказ</title>

    <link rel="shortcut icon" href="../../SushiPictures/The%20Beatles.jpg"
          type="image/x-icon">
    <link rel="stylesheet" href="../../CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../../CSS/MyStyles.css">
</head>

<body>

<div class="container-md">
    <a href="Orders.php">Просмотр заказов</a> / Изменение заказа
</div>


<?php

$ID = TableModel::GetOrderID();

include ("../Forms/UpdateOrderForm.php");


if($ID !== -1)
    {
        echo "<div>";
        TableModel::CheckFile();
        TableModel::UpdateOrder($_SESSION["OrderID"]);
        echo "</div>";
    }
else
    echo "NOPE(";

?>


</body>


<?php
include ("../.core/SushiBottom.php");
?>