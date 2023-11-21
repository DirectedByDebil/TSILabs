<?php
require_once ("../.core/logic.php");
include("../.core/SushiHeader.php");

$import = new Import();
?>


<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name = "description" content="Доставка суши">
    <title>Импорт данных</title>

    <link rel="shortcut icon" href="../../Images/kisspng-better-call-saul-television-poster-font-5afae923c06574.0734994015263931237881.jpg"
          type="image/x-icon">
    <link rel="stylesheet" href="../../CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../../CSS/MyStyles.css">
</head>

<body>


<div class="container-sm p-3 text-center">
    <?php

    include("../Forms/ImportForm.php");

    $import->ImportFile();
    echo"<br>";
    echo $import->GetFileImportedString();

    ?>
    <h1>ИМПОРТ</h1>
</div>


<?php
include("../.core/SushiBottom.php");
?>

</body>
</html>