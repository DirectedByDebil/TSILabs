<?php

if(!empty($_SESSION["username"]))
{
    $username = $_SESSION["username"];
    //var_dump($username); echo "<br>";
    echo "Вы вошли как $username. <u><a href=\"Exit.php\">Выйти</a> </u>";
}
else
{
    echo "Вы не авторизованы. <a href=\"Authorization.php\">Ввести логин и пароль</a> или <a href=\"Registration.php\">зарегистрироваться </a>";
}

