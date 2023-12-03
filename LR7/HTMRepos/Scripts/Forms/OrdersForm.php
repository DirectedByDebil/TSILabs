<?php
require_once ("../.core/logic.php");

$db = new Filter();
?>

<!--Форма-->
<form action="Orders.php" method="get">

    <div class="container-lg text-center img-thumbnail">
        <div class="fs-6 text-bg-secondary rounded-3 ">
            <div class="d-inline-flex flex-column justify-content-sm-center rounded">
                <div class="p-3">
                    <label for="nameOfSet" >Название сета</label><br>
                        <input type="text" id="nameOfSet" name="nameOfSet" placeholder="Название сета" class="w-75" value="<?php echo $db->GetFilter('nameOfSet'); ?>">
                <div class="p-3">
                    <label for="fio" >ФИО заказчика</label><br>
                    <input type="text" name="fio" id="fio" placeholder="Кто заказал?" class="w-75" value="<?php echo $db->GetFilter('fio') ?>"></div>

                <div class="p-3">
                    <label for="tradeOutlet" >Торговая точка</label><br>
                    <select name="tradeOutlet" id="tradeOutlet" type="text" class="w-75">   <br>

                        <option value="">Все доступные</option>

                        <?php foreach ($db->tradeOutlets as $temp)
                        {?>
                            <option value="<?php echo $temp ?>" <?php if ($temp === $db->GetFilter('tradeOutlet') ) echo "selected"; ?> >   <?php echo $temp; ?> </option>
                        <?php }?>

                    </select>
                </div>

                <div class="p-3">
                    <label for="content" >Состав заказа</label><br>
                    <input type="text" name="content" id="content" placeholder="Состав заказа" class="w-75" value="<?php echo $db->GetFilter('content') ?>" </div>

                <div class="p-3">
                    <label for="costMin" >Стоимость от</label><br>
                    <input type="number" id="costMin" name="costMin" placeholder="Цена от" class="w-75" value="<?php echo $db->GetFilter('costMin') ?>"  >
                    <label for="costMax" >Стоимость до</label><br>
                    <input type="number" id="costMax" name="costMax" placeholder="Цена до" class="w-75" value="<?php echo $db->GetFilter('costMax') ?>"> <br>
                </div>

                <div class="p-3">
                    <input type="submit" value="Send)">
                    <input type="submit" name="reset" value="Reset(">
                </div>
            </div>
        </div>
    </div>

</form>
