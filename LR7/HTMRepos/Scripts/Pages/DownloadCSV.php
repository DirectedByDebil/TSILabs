<?php
require_once ("../.core/logic.php");
include ("../.core/SushiHeader.php");


$sqlQuery = "select photo, personal_info, content, cost, trade_outlets.address from orders
        inner join trade_outlets on orders.trade_outlet = trade_outlets.ID";

$sqlResult = $GLOBALS["dbMain"]->ExecuteSQL($sqlQuery);

$export = new Export();

$path = '../../File/';
$path .= $export->GetName();

$fp = fopen($path, 'w+');

if(file_exists($path))
{
    while ($row = $sqlResult->fetch())
    {
        $array = array($row["photo"], $row["personal_info"], $row["address"], $row["content"], $row["cost"]);
        fputcsv($fp, $array);
    }

    fclose($fp);
}
else
{
    echo "Nope";
}

$export->FileForceDownload($path);

/*
$uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/upload/';
$types = [
    'application/vnd.ms-excel',
    'application/json',
    'text/xml',
    'application/xml'
];
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_FILES)
{
    if (!file_exists($uploadDir))
    {
        mkdir($uploadDir);
    }
    $file = array_shift($_FILES);
    if (in_array($file['type'], $types))
    {
        if (move_uploaded_file($file['tmp_name'], $uploadDir . $file['name']))
        {
            echo "<a href='/LR5/upload/{$file['name']}' download='{$file['name']}'>Ссылка на скачивание файла</a>";
        }
        else
        {
            echo 'Файл не был загружен';
        }
    }
    else
    {
        echo 'Неверный тип обрабатываемого файла';
    }
}
*/

include ("../.core/SushiBottom.php");
