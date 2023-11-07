<?php
require_once ("logic.php");
include ("SushiHeader.php");

$htmlWork = new WorkWithHTML();
?>

<!DOCTYPE html>

<html lang="en" xmlns="http://www.w3.org/1999/html" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name = "description" content="Доставка суши">
    <title>Страница для игр с текстом</title>

    <link rel="shortcut icon" href="../Images/kisspng-better-call-saul-television-poster-font-5afae923c06574.0734994015263931237881.jpg"
          type="image/x-icon">
    <link rel="stylesheet" href="../CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../CSS/MyStyles.css">
</head>


<body class="text-bg-light">

<form action="text.php" method="get">
    <div class="container-sm text-center">
        <div class="d-inline-flex flex-column justify-content-sm-center">
            <label for="preset" class="p-1">Вы можете выбрать один из готовых вариантов</label>
            <select id="preset" name="preset">
                <?php $selectedPreset = WorkWithPostAndGet::GetGetData("preset"); ?>
                <option value="0" <?php if ($selectedPreset === "0") echo "selected";?> >Использовать свой текст</option>
                <option value="1" <?php if ($selectedPreset === "1") echo "selected";?> >Вариант про анекдот</option>
                <option value="2" <?php if ($selectedPreset === "2") echo "selected";?> >Вариант про песню</option>
                <option value="3" <?php if ($selectedPreset === "3") echo "selected";?> >Вариант про картинку</option>
            </select>

            <input class="p-1 w-25 align-self-center" type="submit" value="Выбрать">
        </div>
    </div>
</form>


<form action="text.php" method="post">
    <div class="container-sm text-center">
        <div class="d-inline-flex flex-column justify-content-sm-center w-50">
            <label for="htmlText" class="p-1">Введите Ваш html-текст</label>
                <textarea class="p-1" name="htmlText" id ="htmlText" placeholder="Введите сюда html" rows="10" cols="40"><?php echo$htmlWork->PastePreset("htmlText");?></textarea>
            <input class="p-1 w-25 align-self-center" type="submit" value="Выполнить">
        </div>
    </div>
</form>

<div class="container-md text-start">
    <div class="d-inline-flex flex-column w-100 p-3">
        <div class="p-3">
            Задание 1:
            <?php
            $data = WorkWithPostAndGet::GetPostData("htmlText");
                echo $htmlWork->Task1($data);
            ?>
        </div>

        <div class="p-3">
            Задание 7: <br>
            <?php
                echo $htmlWork->Task7($data);
            ?>
        </div>

        <div class="p-3">
            Задание 12: <br>
            <?php
                echo $htmlWork->Task12($data);
            ?>
        </div>

        <div class="p-3">
            Задание 20: <br>
            <?php
                echo $htmlWork->Task20($data);
            ?>
        </div>


    </div>
</div>




</body>

<?php
include ("SushiBottom.php");