<?php

if(!empty($_SESSION["username"]))
{
    $username = $_SESSION["username"];
    //var_dump($username); echo "<br>";
    echo "Вы вошли как $username. <u><a style='color: white' href=\"Exit.php\">Выйти</a> </u>";
}
else
{
    echo "Вы не авторизованы. <a style='color: white' href=\"Authorization.php\">Ввести логин и пароль</a> или <a style='color: white' href=\"Registration.php\">зарегистрироваться </a>";
}

