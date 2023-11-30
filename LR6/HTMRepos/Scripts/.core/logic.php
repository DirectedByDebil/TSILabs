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

    public function GetPDO():PDO
    {
        return $this->pdoConn;
    }

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

class Filter
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
        $resetPressed = isset($_GET["reset"]) && $_GET["reset"] !== "";
        if(!$resetPressed)
        {
            if(!empty($this->currentFilters["$filter"]))
            {
                return $this->currentFilters["$filter"];
            }
        }

        return "";
    }
    public function DrawBD() : void
    {
        $this->CheckSQL();

        $currentResult = $GLOBALS["dbMain"]->ExecuteSQL($this->sqlCurrent);

        while ($row = $currentResult->fetch())
        {
            echo "<tr class='p-3'>";
            $this->DrawRow($row);
            echo "</tr>";
        }
        echo "
    <form action='CreateOrderPage.php'>
        <tr> <td> <input class='white-button' type='submit' value='Create'> </td> </tr>
    </form>
         ";
    }

    private function DrawRow($row) : void
    {
        echo "
    <form action='Orders.php' method='get'>
        <td>   
                $row[photo] <br>
                    <img src=\"../../SushiPictures/$row[photo]\" width='200 px' alt='Здесь должна быть фоточка('> 
        </td>
        <td>  $row[personal_info] </td>
        <td>  $row[address] </td>
        <td>  $row[content] </td>
        <td>  $row[cost]  </td>
        <td> <input class='blue-button' type='submit' name=\"Update $row[photo]\" value='Update'> </td>
        <td> <input class='red-button' type='submit' name=\"Delete $row[photo]\" value='Delete'> </td>
    </form>
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
class Registration
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
class Authorization
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

class Export
{
    private string $name = "orders_exported.csv";

    public function GetName():string
    {
        return $this->name;
    }
    public function GetFileExportedString():string
    {
        if(isset($_POST["Export"]) && $_POST["Export"] != "")
        {
            return "$this->name передан скрипту DownloadCSV.php по протоколу HTTP методом POST. Ссылка для скачивания <a href='../Pages/DownloadCSV.php'> Скачать файл</a>";
        }
        return "";

    }
    function FileForceDownload($file):void
    {
        if (file_exists($file))
        {
            // сбрасываем буфер вывода PHP, чтобы избежать переполнения памяти выделенной под скрипт
            // если этого не сделать файл будет читаться в память полностью!
            if (ob_get_level())
            {
                ob_end_clean();
            }
            // заставляем браузер показать окно сохранения файла
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            // читаем файл и отправляем его пользователю
            readfile($file);
            exit;
        }
    }
}

class Import
{
    private string $newTableName = "orders_imported";
    private int $amountOfRows = 0;

    public function GetFileImportedString():string
    {
        if(isset($_POST["fileURL"]) && $_POST["fileURL"] != "")
        {
            $url = $_POST["fileURL"];
            return "Файл с данными получен из $url и обработан. Создана таблица $this->newTableName с количеством записей: $this->amountOfRows";
        }
        return "";

    }
    public function ImportFile():void
    {
        if(isset($_POST["fileURL"]) && $_POST["fileURL"] != "")
        {
            $url = $_POST["fileURL"];
            $fileRead = fopen($url, 'rb');

            if($fileRead)
            {
                $path = "../../File/$this->newTableName.csv";
                $fileWrite = @fopen($path, 'wb');

                if($fileWrite)
                {
                    ini_set('user_agent', "PHP");

                    $ch = curl_init();
                    $options = array(
                        CURLOPT_FILE    => $fileWrite,
                        CURLOPT_TIMEOUT =>  20,
                        CURLOPT_URL     => $url,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_SSL_VERIFYHOST => false,
                        CURLOPT_SSL_VERIFYPEER => false,
                    );

                    curl_setopt_array($ch, $options);

                    $html = curl_exec($ch);
                    fputs($fileWrite, $html);

                    curl_close($ch);
                }
                fclose($fileWrite);
            }
            else
            {
                echo "Nope";
            }

            fclose($fileRead);
        }

        $this->AddImportedTable();
    }
    private function AddImportedTable():void
    {
        $dropTable = "DROP TABLE IF EXISTS $this->newTableName;";
        $createTable = "CREATE TABLE $this->newTableName like orders;";

        $path = "../../File/$this->newTableName.csv";

        if(file_exists($path))
        {
            $GLOBALS["dbMain"]->ExecuteSQL($dropTable);
            $GLOBALS["dbMain"]->ExecuteSQL($createTable);

            $fileRead = @fopen($path, "rb");

            if($fileRead)
            {
                while( ($row = fgets($fileRead)) !== false )
                {

                    $string = str_replace("\"", " ", $row);
                    $fields = explode(",", $string);

                    $array = array(
                        "photo" =>  " \"$fields[0]\"",
                        "personal_info" => "\"$fields[1]\"",
                        "address" => "$fields[2], $fields[3]",
                        "content" => "\"$fields[4]\"",
                        "cost" => "\"$fields[5]\""
                );

                    $array["address"] = $this->FindTradeOutlet($array["address"]);
                    $this->amountOfRows++;

                    $this->InsertInto($array);
                }
            }

            fclose($fileRead);
        }

    }

    private function FindTradeOutlet($outlet): int
    {
        $selectTradeOutlets = "select * from trade_outlets;";

        $result = $GLOBALS["dbMain"]->ExecuteSQL($selectTradeOutlets);

        while ($row = $result->fetch())
        {
            $address = str_replace(" ","", $row["address"]);
            $outlet = str_replace(" ","", $outlet);

            if(strcmp($address, $outlet) === 0)
            {
                $id = $row["ID"];
                return $id;
            }
        }

        return 1;
    }

    private function InsertInto($array):void
    {
        $insertValues = "insert into $this->newTableName values(";

        $insertValues .= "$this->amountOfRows";

        foreach($array as $item)
        {
            $insertValues .= ", $item";
        }

//var_dump($array);
//echo "<br>";
        $insertValues .= ");";

        $GLOBALS["dbMain"]->ExecuteSQL($insertValues);
    }
}

class TableModel
{
    public static function CheckFile()
    {
        $input_name = 'photo';
        $path = '../../SushiPictures/';

        $allow = array('jpg', 'png');
        $deny = array(
            'phtml', 'php', 'php3', 'php4', 'php5', 'php6', 'php7', 'phps', 'cgi', 'pl', 'asp',
            'aspx', 'shtml', 'shtm', 'htaccess', 'htpasswd', 'ini', 'log', 'sh', 'js', 'html',
            'htm', 'css', 'sql', 'spl', 'scgi', 'fcgi', 'pdf', 'exe'
        );

        if (isset($_FILES[$input_name]))
        {
            if (!is_dir($path))
                mkdir($path, 0777, true);

            // Преобразуем массив $_FILES в удобный вид для перебора в foreach.
            $files = array();
            $diff = count($_FILES[$input_name]) - count($_FILES[$input_name], COUNT_RECURSIVE);
            if ($diff == 0)
            {
                $files = array($_FILES[$input_name]);
            }
            else
            {
                foreach($_FILES[$input_name] as $k => $l)
                {
                    foreach($l as $i => $v)
                        $files[$i][$k] = $v;
                }
            }

            foreach ($files as $file)
            {
                $error = $success = '';

                // Проверим на ошибки загрузки.
                if (!empty($file['error']) || empty($file['tmp_name']))
                {
                    switch (@$file['error'])
                    {
                        case 1:
                        case 2: $error = 'Превышен размер загружаемого файла.'; break;
                        case 3: $error = 'Файл был получен только частично.'; break;
                        case 4: $error = 'Файл не был загружен.'; break;
                        case 6: $error = 'Файл не загружен - отсутствует временная директория.'; break;
                        case 7: $error = 'Не удалось записать файл на диск.'; break;
                        case 8: $error = 'PHP-расширение остановило загрузку файла.'; break;
                        case 9: $error = 'Файл не был загружен - директория не существует.'; break;
                        case 10: $error = 'Превышен максимально допустимый размер файла.'; break;
                        case 11: $error = 'Данный тип файла запрещен.'; break;
                        case 12: $error = 'Ошибка при копировании файла.'; break;
                        default: $error = 'Файл не был загружен - неизвестная ошибка.'; break;
                    }
                }
                elseif ($file['tmp_name'] == 'none' || !is_uploaded_file($file['tmp_name']))
                    $error = 'Не удалось загрузить файл.';
                else
                {
                    // Оставляем в имени файла только буквы, цифры и некоторые символы.
                    $pattern = "[^a-zа-яё0-9,~!@#%^-_\$\?\(\)\{\}\[\]\.]";

                    $parts = pathinfo($file['name']);

                    if($_POST["nameOfSet"] !== "")
                        $name = $_POST["nameOfSet"].".".$parts['extension'];
                    else
                        $name = $file['name'];

                    var_dump($name);

                    //$name = mb_eregi_replace($pattern, '-', $name);
                    //$name = mb_ereg_repace('[-]+', '-', $name);

                    // Т.к. есть проблема с кириллицей в названиях файлов (файлы становятся недоступны).
                    // Сделаем их транслит:
                    $converter = array(
                        'а' => 'a',   'б' => 'b',   'в' => 'v',    'г' => 'g',   'д' => 'd',   'е' => 'e',
                        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',    'и' => 'i',   'й' => 'y',   'к' => 'k',
                        'л' => 'l',   'м' => 'm',   'н' => 'n',    'о' => 'o',   'п' => 'p',   'р' => 'r',
                        'с' => 's',   'т' => 't',   'у' => 'u',    'ф' => 'f',   'х' => 'h',   'ц' => 'c',
                        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',  'ь' => '',    'ы' => 'y',   'ъ' => '',
                        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

                        'А' => 'A',   'Б' => 'B',   'В' => 'V',    'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
                        'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',    'И' => 'I',   'Й' => 'Y',   'К' => 'K',
                        'Л' => 'L',   'М' => 'M',   'Н' => 'N',    'О' => 'O',   'П' => 'P',   'Р' => 'R',
                        'С' => 'S',   'Т' => 'T',   'У' => 'U',    'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
                        'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',  'Ь' => '',    'Ы' => 'Y',   'Ъ' => '',
                        'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
                    );

//                    $name = strtr($name, $converter);
                    $parts = pathinfo($name);

                    if (empty($name) || empty($parts['extension']))
                    {
                        $error = 'Недопустимое тип файла';
                    } elseif (!empty($allow) && !in_array(strtolower($parts['extension']), $allow)) {
                        $error = 'Недопустимый тип файла';
                    } elseif (!empty($deny) && in_array(strtolower($parts['extension']), $deny)) {
                        $error = 'Недопустимый тип файла';
                    } else {
                        // Чтобы не затереть файл с таким же названием, добавим префикс.
                        $i = 0;
                        $prefix = '';
                        while (is_file($path . $parts['filename'] . $prefix . '.' . $parts['extension'])) {
                            $prefix = '(' . ++$i . ')';
                        }
                        $name = $parts['filename'] . $prefix . '.' . $parts['extension'];
                        $_FILES[$input_name]['name'] = $name;

                        // Перемещаем файл в директорию.
                        if (move_uploaded_file($file['tmp_name'], $path . $name)) {
                            // Далее можно сохранить название файла в БД и т.п.
                            $success = 'Файл «' . $name . '» успешно загружен.';
                        } else {
                            $error = 'Не удалось загрузить файл.';
                        }
                    }
                }

                if (!empty($success))
                    echo '<p>' . $success . '</p>';
                else
                    echo '<p>' . $error . '</p>';

            }

        }

    }
    public static function CreateOrder()
    {
        if(isset($_FILES["photo"]) && isset($_POST))
        {
            if($_POST["fio"] !== "" && $_POST["content"] !== "" && $_POST["cost"] !== "")
            {
                $query = $GLOBALS["dbMain"]->GetPDO()->prepare(
                    "insert into orders (photo, personal_info, trade_outlet, content, cost)".
                    "values (:photo, :personal_info, :trade_outlet, :content, :cost);"
                );

                $query->bindValue(":photo", $_FILES['photo']['name']);
                $query->bindValue(":personal_info", $_POST["fio"]);
                $query->bindValue(":trade_outlet", $_POST["tradeOutlet"]);
                $query->bindValue(":content", $_POST["content"]);
                $query->bindValue(":cost", $_POST["cost"]);

                if(!$query->execute())
                {
                    throw new PDOException('При добавлении возникла ошибка');
                }
            }
        }
    }


}
