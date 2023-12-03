<?php
require_once ("../.core/logic.php");

$filter = new Filter();
?>


<form enctype="multipart/form-data" action="CreateOrderPage.php" method="post">
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
                    $count = 1;
                    foreach ($filter->tradeOutlets as $temp)
                    {?>
                        <option value="<?php echo $count?>"> <?php echo $temp; ?> </option>
                    <?php $count++;
                    }
                    ?>
                </select>
            </td>

            <td colspan="2" >
                <input type="file" placeholder="Изображение" name="photo">  </td>
            <td> <input type="submit" value="Создать заказ" name="CreateOrder" class="green-button"> </td>
        </tr>
    </table>

</form>
