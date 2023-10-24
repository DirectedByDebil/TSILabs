<?php

ob_start();
session_start();


class ConnectToDB
{
    private string $servername = "localhost", $username = "root",
        $password = "windowsActivation0110", $dbname;

    private mysqli $conn;

    public function __construct($dbname)
    {
        $this->dbname = $dbname;
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if($this->conn->connect_errno)
        {
            echo "Не удалось подключиться(";
            exit();
        }

        if(!$this->conn->set_charset("utf8"))
        {
            printf("Ошибка при установке кодировки(: %s\n", $this->conn->error);
            exit();
        }
    }
    public function ExecuteSQL($sql)
    {
        //if(!empty($this->conn->query($sql)))
            return $this->conn->query($sql);
    }
}

class WorkWithFilter
{
    public array $tradeOutlets = array();

    private ConnectToDB $db;
    private array $currentFilters;

    private string $dbname = "sushidb", $sqlCurrent;

    public function __construct()
    {
        $this->sqlCurrent = "select photo, personal_info, content, cost, trade_outlets.address from orders
        inner join trade_outlets on orders.trade_outlet = trade_outlets.ID";
        $this->db = new ConnectToDB($this->dbname);

        $arrayOfFilters = array("nameOfSet", "fio", "tradeOutlet", "content", "costMin", "costMax");
        $this->currentFilters = array_fill_keys($arrayOfFilters, 0);

        foreach ($arrayOfFilters  as $item)
        {
            if(isset($_GET[$item]))
                $this->currentFilters[$item] = $_GET[$item];
        }

        $currentResult = $this->db->ExecuteSQL($this->sqlCurrent);
        while ($currentRow = $currentResult->fetch_assoc() )
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

        $currentResult = $this->db->ExecuteSQL($this->sqlCurrent);

        while ($row = $currentResult->fetch_assoc())
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
    private ConnectToDB $conn;

    public  function __construct()
    {
        $this->insertString = "insert into users values";
        $this->conn = new ConnectToDB("sushidb");
    }

    public  function GetData($data) : void
    {
        if(!empty($_POST[$data]))
        {
            echo $_POST[$data];
        }
        else
            echo "";
    }
    public  function GetSex($choice) : string
    {
        if(!empty($_POST[$choice]))
            return $_POST[$choice];

        return "";
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
        $result = $this->conn->ExecuteSQL("Select login from users where login = '"."$_POST[login]"."';");

        if(empty($result->fetch_assoc()))
            return false;

        return true;
    }
    private function AddUser():void
    {
        $result = $this->conn->ExecuteSQL($this->insertString);
    }

}

class WorkWithAuthorization
{
    private ConnectToDB $conn;

    public function __construct()
    {
        $this->conn = new ConnectToDB("sushidb");
    }

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

    public function GetLogin() : void
    {
        if(!empty($_POST["login"]))
            echo $_POST["login"];
        else
        {
            echo "";
        }
    }
    public function GetPassword() :void
    {
        if(!empty($_POST["password"]))
            echo $_POST["password"];
        else
            echo "";
    }

    private function CheckLoginExistence():bool
    {
        $loginsFromDb = $this->conn->ExecuteSQL("Select login from users;");
        $logins = array();

        while ($login = $loginsFromDb->fetch_assoc())
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
        $passwordsFromDb = $this->conn->ExecuteSQL("Select password from users;");

        while ($password = $passwordsFromDb->fetch_assoc())
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
        $fio = $this->conn->ExecuteSQL("Select fio from users where login = '$login';");
        return $fio;
    }


}

