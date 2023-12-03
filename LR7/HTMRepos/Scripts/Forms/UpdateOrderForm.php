<?php
require_once ("../.core/logic.php");

?>

<div class="text-center p-3">

<form enctype="multipart/form-data" action="UpdateOrderPage.php" method="post">
    <table style="display: inline-block">
        <tr>
            <td>  <input type="text" placeholder="Название сета" name="nameOfSet"
                         value="<?php echo WorkWithPostAndGet::GetPostData("nameOfSet");?>">  </td>
            <td>  <input type="text" placeholder="ФИО заказчика" name="fio"
                         value="<?php echo WorkWithPostAndGet::GetPostData("fio");?>">  </td>
            <td>  <input type="text" placeholder="Состав заказа" name="content"
                         value="<?php echo WorkWithPostAndGet::GetPostData("content");?>">  </td>
            <td>  <input type="text" placeholder="Стоимость заказа" name="cost"
                         value="<?php echo WorkWithPostAndGet::GetPostData("cost");?>">  </td>
        </tr>

        <tr>
            <td>
                <label for="tradeOutlet" >Торговая точка</label><br>
                <select name="tradeOutlet" id="tradeOutlet" type="text" class="w-75">   <br>
                    <?php

                    $outlets = $GLOBALS["dbMain"]->ExecuteSQL("Select * from trade_outlets");

                    while ($outlet = $outlets->fetch(PDO::FETCH_ASSOC))
                    {?>
                        <option value="<?php echo $outlet['ID']?>"
                            <?php if ($outlet['address'] === $_POST["tradeOutlet"] ) echo "selected"; ?> > <?php echo $outlet['address']; ?> </option>
                        <?php
                    }
                    ?>
                </select>
            </td>

            <td colspan="2" >
                <input type="file" placeholder="Изображение" name="photo">  </td>
            <td> <input type="submit" value="Обновить заказ" class="blue-button"> </td>
        </tr>
    </table>

</form>

</div>

