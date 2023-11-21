<?php
require_once("../.core/logic.php");
include("../.core/SushiHeader.php");

$export = new Export();
?>


<!doctype html>

<html lang="en" xmlns="http://www.w3.org/1999/html" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name = "description" content="Доставка суши">
    <title>Экспорт данных</title>

    <link rel="shortcut icon" href="../../Images/kisspng-better-call-saul-television-poster-font-5afae923c06574.0734994015263931237881.jpg"
          type="image/x-icon">
    <link rel="stylesheet" href="../../CSS/bootstrap.min.css">
    <link rel="stylesheet" href="../../CSS/MyStyles.css">
</head>

<body>


<?php include("../Forms/ExportForm.php");?>

<div class="p-3 text-center">
    <h1>Экспорт</h1>

    <div class="d-inline-flex flex-row">
        <?php echo $export->GetFileExportedString(); ?>
    </div>

</div>


<?php include("../.core/SushiBottom.php");?>

</body>
</html>