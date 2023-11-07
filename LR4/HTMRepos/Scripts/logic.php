<?php

$dbMain = new ConnectToDB("sushidb");


ob_start();
session_start();


class WorkWithPostAndGet
{
    public static function GetPostData($data)
    {
        if(isset($_POST[$data]))
            return $_POST[$data];
        else return "";
    }
    public static function GetGetData($data)
    {
        if(isset($_GET[$data]))
            return $_GET[$data];
        else return "";
    }
}
class ConnectToDB
{
    private string $servername = "localhost", $username = "root",
        $password = "windowsActivation0110";

    private  PDO $pdoConn;

    public function __construct($dbname)
    {
        $string = "mysql:host=$this->servername;dbname=$dbname";
        $this->pdoConn = new PDO($string, $this->username, $this->password);

        if($this->pdoConn->errorCode() != null)
        {
            echo "We have some errors(";
            exit();
        }
    }
    public function ExecuteSQL($sql) : PDOStatement
    {
        return $this->pdoConn->query($sql);
    }
}



class WorkWithFilter
{
    public array $tradeOutlets = array();

    private array $currentFilters;
    private string $sqlCurrent;

    public function __construct()
    {
        $this->sqlCurrent = "select photo, personal_info, content, cost, trade_outlets.address from orders
        inner join trade_outlets on orders.trade_outlet = trade_outlets.ID";

        $arrayOfFilters = array("nameOfSet", "fio", "tradeOutlet", "content", "costMin", "costMax");
        $this->currentFilters = array_fill_keys($arrayOfFilters, 0);

        foreach ($arrayOfFilters  as $item)
        {
            if(isset($_GET[$item]))
                $this->currentFilters[$item] = $_GET[$item];
        }

        $currentResult = $GLOBALS["dbMain"]->ExecuteSQL($this->sqlCurrent);
        while ($currentRow = $currentResult->fetch() )
        {
            array_push($this->tradeOutlets, $currentRow["address"] );
        }
        $this->tradeOutlets = array_unique($this->tradeOutlets);
    }
    public function GetFilter($filter)
    {
        if(!empty($this->currentFilters["$filter"]))
        {
            return $this->currentFilters["$filter"];
        }

        return "";
    }
    public function DrawBD() : void
    {
        $this->CheckSQL();

        $currentResult = $GLOBALS["dbMain"]->ExecuteSQL($this->sqlCurrent);

        while ($row = $currentResult->fetch())
        {
            $this->DrawRow($row);
        }
    }

    private function DrawRow($row) : void
    {
        echo "
            <div class=\"d-flex flex-row justify-content-md-start text-bg-light\">
                <div class=\"p-3 w-25 \">
                $row[photo] <br>
                    <img src=\"../SushiPictures/$row[photo].jpg\" width='200 px' alt='Здесь должна быть фоточка('> 
                </div> <div class='vr'> </div>
        
                <div class=\"p-3 w-25\">
                    $row[personal_info]
                </div> <div class='vr'> </div>
        
                <div class=\"p-3 w-25\">
                    $row[address]
                </div> <div class='vr'> </div>
        
                <div class=\"p-3 w-25\">
                   $row[content]
                </div> <div class='vr'> </div>
        
                <div class=\"p-3 w-25\">
                   $row[cost]
                </div>

            </div>
             ";
    }
    private function CheckSQL():void
    {
        $arrayOfFilters = array();
        if (isset($this->currentFilters))
        {
            foreach ($this->currentFilters as $currentF)
            {
                if($currentF != 0 && $currentF != "")
                {
                    $key = array_search("$currentF", $this->currentFilters);

                    $arrayOfFilters[$key] = $currentF;
                }
            }
        }

        $string = " where ";
        if( count( $arrayOfFilters) === 0)
        {
            $string="";
        }
        else
        {
            $last = end($arrayOfFilters);

            foreach ($arrayOfFilters as $filter)
            {
                $string .= $this->GetFilterRule($filter);

                if(count($arrayOfFilters) > 1 && $last != $filter)
                {
                    $string .= " and ";
                }
            }
        }

        $this->sqlCurrent .= $string.";";
    }
    private function GetFilterRule($filter) : string
    {
        $key = array_search($filter, $this->currentFilters);

        switch ($key)
        {
            case "nameOfSet":
                return "photo = '$filter' ";
            case "fio":
                return "personal_info = '$filter'";
            case "tradeOutlet":
                return "address = '$filter'";
            case "content":
                return "content = '$filter'";
            case "costMin":
                return "cost > $filter";
            case "costMax":
                return "cost < $filter";

        }

        return "";
    }
}
class WorkWithRegistration
{
    private string $insertString;

    public  function __construct()
    {
        $this->insertString = "insert into users values";
    }
    public function CheckEssentials() : void
    {
        if(!empty($_POST["login"]) and !empty($_POST["password1"]) and !empty($_POST["password2"]) and !empty($_POST["fio"]))
        {
            if(!$this->CheckLogin() and $this->CheckPasswords() )
            {
                $this->MakeInsertInto();
                $this->AddUser();

                $_SESSION["username"] = $_POST["fio"];
                header("Location: SushiMain.php");
                exit();
            }
            else if($this->CheckLogin())
            {
                echo "email занят!";
            }
        }
        else
        {
            echo "Обязательные поля: логин, пароли и ФИО";
        }
    }

    private function MakeInsertInto() : void
    {
        $values = array($_POST["login"], password_hash($_POST["password1"], PASSWORD_DEFAULT), $_POST["fio"],
            $_POST["dateOfBirth"], $_POST["address"], $_POST["hobby"], $_POST["url"], $_POST["rezus"],
             $_POST["bloodType"], $_POST["sex"] );

        $this->insertString .=" (";

        foreach ($values as $column)
        {
            if($column === "")
            {
                $this->insertString .= "null, ";
            }
            else
            {
                $this->insertString .= "'".$column."', ";
            }
        }

        $this->insertString = substr ($this->insertString, 0, strlen ($this->insertString)-2);
        $this->insertString .=");";
        //echo $this->insertString;
    }
    private function CheckPasswords() : bool
    {
        if($_POST["password1"] != $_POST["password2"])
        {
            echo "Пароли не совпадают(";
            return false;
        }
        else
        {
            $password = $_POST["password1"];

            $condition = strlen($password) > 6
            and preg_match('/[A-Z]/', $password)
                /*and preg_match('/[a-z]/', $password)
                and str_contains($password, " ")
                and str_contains($password, "-")
                and str_contains($password, "_")
                and preg_match('/[0-9]/', $password)
                and !preg_match('/[А-Я]/', $password)*/;
            if (!$condition )
            {
                echo "Требования к паролю: длиннее 6 символов,
                     обязательно содержит большие латинские буквы,
                      маленькие латинские буквы, 
                      спецсимволы (знаки препинания, арифметические действия и тп),
                       пробел, дефис, подчеркивание и цифры. Русские буквы запрещены.";
                return false;
            }

            return true;
        }
    }
    private function CheckLogin() : bool
    {
        $result = $GLOBALS["dbMain"]->ExecuteSQL("Select login from users where login = '"."$_POST[login]"."';");

        if(empty($result->fetch()))
            return false;

        return true;
    }
    private function AddUser():void
    {
        $result = $GLOBALS["dbMain"]->ExecuteSQL($this->insertString);
    }
}
class WorkWithAuthorization
{
    public function GetWarning() : void
    {
        if(!empty($_POST["login"]) and !empty($_POST["password"]))
        {
            if(!$this->CheckLoginExistence())
            {
               echo "Нет такого логина!";
            }
            else if (!$this->CheckPasswordValidness())
            {
                echo " Неправильный пароль!";
            }
            else
            {
                //$_SESSION["username"] = $this->GetFIO();
                $_SESSION["username"] = $_POST["login"];
                header("Location: SushiMain.php");
                exit();
            }
        }
    }

    private function CheckLoginExistence():bool
    {
        $loginsFromDb = $GLOBALS["dbMain"]->ExecuteSQL("Select login from users;");
        $logins = array();

        while ($login = $loginsFromDb->fetch())
        {
            $logins[] = $login["login"];
        }

        if(!in_array($_POST["login"], $logins))
        {
            return false;
        }

        return true;
    }
    private function CheckPasswordValidness():bool
    {
        $passwords = array();
        $passwordsFromDb = $GLOBALS["dbMain"]->ExecuteSQL("Select password from users;");

        while ($password = $passwordsFromDb->fetch())
        {
            $passwords[] = $password["password"];
        }

        foreach ($passwords as $currentPassword)
        {
            if(password_verify($_POST["password"], $currentPassword))
            {
                return true;
            }
        }

        return false;
    }
    private function GetFIO()
    {
        $login = $_POST["login"];
        $fio = $GLOBALS["dbMain"]->ExecuteSQL("Select fio from users where login = '$login';");
        return $fio;
    }

}

class  WorkWithHTML
{
    private DOMDocument $dom;

    public function __construct()
    {
        $this->dom = new DOMDocument();
    }

    public function PastePreset($name)
    {
        $result="";

        if(isset($_GET["preset"]) && $_GET["preset"] != "0")
        {
            switch ($_GET["preset"])
            {
                case "1":
                    $result = "Всем хорошего дня!!!!!!! САМОГО ЛУЧШЕГО!!!!! Кайф Вернулся))))) ЫЫЫЫЫ,,,,,,, Я здесь??????.......такой замечательный день)))) и загадочный.....";
                    break;
                case "2":
                    $result = "And now is time for <div class='orange'> <h1>BIG H1 HEADER!!!!!!!!!!!!</h1> and you now what???????????? </div> <h2>HERE COMES ........ A LITTLE BIT SMALLER HEADER H2!</h2>
Are you still not impressed? Well,,,,,,, it's time for::::::: <h1>ANOTHER BIG HEADER!!!</h1> Thanks))))))) for your attention!";
                    break;
                case "3":
                    $result = "
HELLO!!!!!!!!!!!!!!!!!
<h1 class='orange'>This is page about Tables in HTML))))))))</h1>


<table>
<caption>Products</caption>
  <tr>
    <th style='color: #6f42c1; background: yellow;'>№</th>
    <th>Name of product</th>
    <th>Measure</th>
    <th>Amount</th>
    <th>Price for one</th>
    <th style='color: yellow; background: #6f42c1;' >Cost</th>
  </tr>
  <tr style='color: #6f42c1; background: yellow;'>
    <td>1.</td>
    <td>Tomatoes</td><td>кг</td><td>15,20</td><td>69,00</td><td>1048,80</td>
  </tr>
  <tr>
    <td>2.</td>
    <td>Cucumbers</td><td>кг</td><td>2,50</td><td>48,00</td><td>120,00</td>
  </tr>
  <tr>
    <td colspan=\"5\" style=\"text-align:right\">SUMMARY:</td><td>1168,80</td>
  </tr>
</table>

<h2 style='color: #6f42c1; background: yellow;'>How about something new?????</h2>

<table>
<caption>Table in table</caption>
    <tr>
        <th>Опа-опа</th>
        <th>Па-па-па</th>
    </tr>

    <tr style='color: yellow; background: #6f42c1;'>
        <td>Ячейка 1.1</td>
        <td>Ячейка 1.2</td>
    </tr>
    <tr>
        <td>
            <table>
                <tr>
                    <th>НОВАЯ ОПА-ОПА</th>
                    <th style='color: #6f42c1; background: yellow;' >НОВАЯ ПА-ПА-ПА</th>
                </tr>
                <tr>
                    <td>Ячейка 2.1 - 1.1</td>
                    <td>Ячейка 2.1 - 1.2</td>
                </tr>
                <tr>
                    <td>Ячейка 2.1 - 2.1</td>
                    <td>Ячейка 2.1 - 2.2</td>
                </tr>
            </table>
        </td>
        <td style='color: yellow; background: #6f42c1;' >Ячейка 2.2</td>
    </tr>
</table>



";
                    break;
            }
        }
        else
        {
            $result = WorkWithPostAndGet::GetPostData($name);
        }

        return $result;
    }
    public function Task1($data)
    {
        $currentIndex = min( mb_strpos($data, "<h1>"), mb_strpos($data, "<h2>"));
        if($currentIndex === false)
            $currentIndex = max( mb_strpos($data, "<h1>"), mb_strpos($data, "<h2>"));


        $resultString = "<ol> <li>This is our list: <ol> ";

        while ($currentIndex !== false)
        {
            $nextIndex = min( mb_strpos($data, "</h1>", $currentIndex), mb_strpos($data, "</h2>", $currentIndex));

            if($nextIndex === false)
                $nextIndex = max( mb_strpos($data, "</h1>", $currentIndex), mb_strpos($data, "</h2>", $currentIndex));

            $resultString .= substr($data, $currentIndex, $nextIndex-$currentIndex);

            $currentIndex = min( mb_strpos($data, "<h1>", $nextIndex), mb_strpos($data, "<h2>", $nextIndex));

            if($currentIndex === false)
                 $currentIndex = max( mb_strpos($data, "<h1>", $nextIndex), mb_strpos($data, "<h2>", $nextIndex));
        }

        $resultString = str_replace("<h1>", "<li>", $resultString);
        $resultString = str_replace("</h1>", "</li>", $resultString);
        $resultString = str_replace("<h2>", "<li>", $resultString);
        $resultString = str_replace("</h2>", "</li>", $resultString);
        $resultString .= "</ol> </li> </ol>";

        return $this->ExecuteContent($resultString);
    }
    public function Task7($data)
    {
        $arrayOfMarks = array(
            0 => "....",
            1 => "!!!!",
            2 => "????",
            3 => "))))",
            4 => "((((",
            5 => ",,,,",
            6 => ";;;;",
            7 => "::::",
            8 => "----",
            9 => "''''",
            10 => "\"\"\"\""
        );

        $currentIndex = 0;
        while(preg_match('/\p{P}/', $data))
        {
            $this->ReplaceMark($data, $arrayOfMarks[$currentIndex]);
            $currentIndex ++;

            if($currentIndex === count($arrayOfMarks))
                break;
        }

        //return $this->ExecuteContent($data);
        return $data;
    }
    public function Task12($data)
    {
        $currentTable = strpos($data, "<table>");
        $index = 0;

        echo "<ol>";
        while ($currentTable !== false)
        {
            $firstRecordStart = strpos($data, "<td>", $currentTable);
            $firstRecordEnd = strpos($data, "</td>", $currentTable);

            $text = substr($data, $firstRecordStart, $firstRecordEnd-$firstRecordStart);

            $insertString = "<a id = \"table $index\"> $text </a>";

            $data = substr_replace($data, $insertString , $firstRecordStart, strlen($text));

            echo "
            <li> <a href='#table $index'>$text</a> </li> ";

            $index++;
            $currentTable = strpos($data, "<table>", $currentTable+1);
        }

        echo "</ol>";


        return $data;
    }
    public function Task20($data)
    {
        $needle = "style='";
        $currentStyle = strpos($data, $needle);
        $amount = 0;

        while($currentStyle !== false)
        {
            $styleBorder = strpos($data, "'", $currentStyle+strlen($needle));

            $style = substr($data, $currentStyle+strlen($needle), $styleBorder-$currentStyle-strlen($needle));
            $amount =substr_count($data, $style);

            if($amount > 1)
            {
                $name = $this->CreateCSSClass($style);
                $replaceString = "class = '$name'";

                $data = str_replace($needle.$style."'", $replaceString, $data);
            }

            $currentStyle = strpos($data, $needle, $currentStyle+1);
        }

        return $data;
    }


    private function ExecuteContent($content)
    {
        if($content != null)
        {
            $this->dom->loadHTML($content);
            return $this->dom->saveHTML();
        }

        return "";
    }
    private function ReplaceMark(&$data, $mark) : void
    {
        $newMark = substr($mark,1);
        $currentIndex = strpos($data, $mark);

        while ($currentIndex !== false)
        {
            $data = str_replace($mark, $newMark, $data);
            $currentIndex = strpos($data, $mark);
        }
    }
    private function CreateCSSClass($style) : string
    {
        $name = str_replace(";", "", $style);
        $name = str_replace(":", "", $name);
        $name = str_replace("#", "", $name);
        $name = str_replace(" ", "", $name);
        echo "
        <style>
         .$name
         {
            $style;
         }
         
         </style>
        ";
        return $name;
    }
}
