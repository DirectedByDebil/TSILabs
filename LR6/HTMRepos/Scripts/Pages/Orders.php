<?php
require_once("../.core/logic.php");

//$db = new Filter();
include("../.core/SushiHeader.php");
?>


<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name = "description" content="Фильтр суши">
    <title>Фильтр сетов</title>

    <link rel="shortcut icon" href="../../SushiPictures/The%20Beatles.jpg"
          type="image/x-icon">
    <link rel="stylesheet" href="../../CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../../CSS/MyStyles.css">
</head>

<body>

<div>
    <?php
    include ("../Forms/OrdersForm.php");
    ?>
</div>

<!--Суши из БД-->
 <div class="container-md text-bg-dark rounded img-thumbnail" style="text-align: center">
     <table style="display: inline-block">
         <tr class="p-3">
             <th>Изображение  </th>
             <th>ФИО заказчика </th>
             <th>Торговая точка самовывоза </th>
             <th>Состав заказа </th>
             <th>Стоимость </th>
             <th>        </th>
             <th>        </th>
         </tr>

        <?php $db->DrawBD(); ?>
     </table>
</div>

<?php

include("../.core/SushiBottom.php"); ?>


</body>
</html>


