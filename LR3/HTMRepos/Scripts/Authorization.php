<?php
require_once ("logic.php");
echo "<title>Авторизация</title>";

include ("SushiHeader.php");
?>
    <!DOCTYPE html>

    <html lang="en" xmlns="http://www.w3.org/1999/html" data-bs-theme="light">
    <head>
        <meta charset="UTF-8">
        <meta name = "description" content="Доставка суши">
        <title>Регистрация</title>

        <link rel="shortcut icon" href="../Images/kisspng-better-call-saul-television-poster-font-5afae923c06574.0734994015263931237881.jpg"
              type="image/x-icon">
        <link rel="stylesheet" href="../CSS/bootstrap.min.css">
    </head>


    <body class="text-bg-light">

    <?php
    include ("Forms/AuthorizationForm.php");
    ?>


    </body>
    </html>


<?php
include ("SushiBottom.php");
