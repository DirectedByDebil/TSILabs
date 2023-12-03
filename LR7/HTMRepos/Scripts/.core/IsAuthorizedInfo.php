<?php

if(!empty($_SESSION["username"]))
{
    $username = $_SESSION["username"];
    //var_dump($username); echo "<br>";
    echo "Вы вошли как $username <a style='color: white' href='../.core/Exit.php' >Выйти</a> </u>";
}
else
{
    echo "Вы не авторизованы. <a style='color: white' href=\"../Pages/Authorization.php\">Ввести логин и пароль</a> или <a style='color: white' href=\"../Pages/Registration.php\">зарегистрироваться </a>";
}


