<?php
require_once("../.core/logic.php");



include("../.core/SushiHeader.php");
?>


<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name = "description" content="Создать заказ">
    <title>Создание заказа</title>

    <link rel="shortcut icon" href="../../SushiPictures/The%20Beatles.jpg"
          type="image/x-icon">
    <link rel="stylesheet" href="../../CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../../CSS/MyStyles.css">
</head>

<body>

<div class="container-md">
    <a href="Orders.php">Просмотр заказов</a> / Создание заказа
</div>


<div class="container-md text-center p-3">
    <?php
    include ("../Forms/CreateOrderForm.php");

    TableModel::CheckFile();

    TableModel::CreateOrder();
    ?>
</div>

<?php include("../.core/SushiBottom.php"); ?>
</body>
</html>



