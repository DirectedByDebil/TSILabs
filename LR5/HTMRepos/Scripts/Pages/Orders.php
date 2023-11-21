<?php
require_once("../.core/logic.php");

$db = new Filter();
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
</head>

<body>

<?php include("../.core/SushiHeader.php"); ?>

<div>

<!--Форма-->
<form action="Orders.php" method="get">

    <div class="container-lg text-center img-thumbnail">
        <div class="fs-6 text-bg-secondary rounded-3 ">
            <div class="d-inline-flex flex-column justify-content-sm-center rounded">
                <div class="p-3">
                    Название сета <br>
                    <input type="text" name="nameOfSet" placeholder="Название сета" class="w-75" value="<?php echo $db->GetFilter('nameOfSet'); ?>"> </div>

                <div class="p-3">
                    ФИО заказчика <br>
                    <input type="text" name="fio" placeholder="Кто заказал?" class="w-75" value="<?php echo $db->GetFilter('fio') ?>"></div>

                <div class="p-3">
                    Торговая точка <br>
                    <select name="tradeOutlet" type="text" class="w-75" id="tradeOutlet">   <br>

                        <option value="">Все доступные</option>

                        <?php foreach ($db->tradeOutlets as $temp)
                        {?>
                            <option value="<?php echo $temp ?>" <?php if ($temp === $db->GetFilter('tradeOutlet') ) echo "selected"; ?> >   <?php echo $temp; ?> </option>
                        <?php }?>

                    </select>

                </div>

                <div class="p-3">
                    Состав заказа <br>
                    <input type="text" name="content" placeholder="Состав заказа" class="w-75" value="<?php echo $db->GetFilter('content') ?>" </div>

                <div class="p-3">
                    Стоимость <br>
                    <input type="number" name="costMin" placeholder="Цена от" class="w-75" value="<?php echo $db->GetFilter('costMin') ?>"  >
                    <input type="number" name="costMax" placeholder="Цена до" class="w-75" value="<?php echo $db->GetFilter('costMax') ?>"> <br>
                    </div>

                <div class="p-3">
                    <input type="submit" value="Send)">
                    <input type="reset" name="reset" value="Reset(">
                </div>
            </div>
        </div>
    </div>

</form>

</div>

<!--Суши из БД-->
 <div class="container-md  text-bg-dark rounded img-thumbnail">
    <div class="fs-5 align-items-start px-4 py-4">
        <div class="d-flex flex-row justify-content-md-start">
            <div class="p-3 w-25">Изображение</div>
            <div class="p-3 w-25">ФИО заказчика</div>
            <div class="p-3 w-25">Торговая точка самовывоза</div>
            <div class="p-3 w-25">Состав заказа</div>
            <div class="p-3 w-25">Стоимость</div>
        </div>
        <?php $db->DrawBD(); ?>

    </div>
</div>

<?php include("../.core/SushiBottom.php"); ?>


</body>
</html>


