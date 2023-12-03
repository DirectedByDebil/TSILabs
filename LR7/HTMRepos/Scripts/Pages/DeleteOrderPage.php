<?php
require_once ("../.core/logic.php");

TableModel::DeleteOrder();

header("Location: Orders.php");
exit();