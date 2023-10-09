<?php

class WorkWithDB
{
    public $tradeOutlets = array();

    private $currentFilters;

    private $servername = "localhost";
    private $username = "root";
    private $password = "windowsActivation0110";
    private $dbname = "sushidb";

    private $conn;
    private $sqlMain;
    private $sqlCurrent;
    private $resultMain;


    public function __construct()
    {
        $this->sqlMain = "select photo, personal_info, content, cost, trade_outlets.address from orders
        inner join trade_outlets on orders.trade_outlet = trade_outlets.ID";

        $this->sqlCurrent = $this->sqlMain;

        $this->currentFilters = array("nameOfSet"=> $_GET["nameOfSet"], "fio"=> $_GET["fio"],
            "tradeOutlet"=> $_GET["tradeOutlet"], "content"=>$_GET["content"],
            "costMin"=>$_GET["costMin"], "costMax"=>$_GET["costMax"]);

        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        $this->resultMain = $this->conn->query($this->sqlCurrent);

        while ($currentRow = $this->resultMain->fetch_assoc() )
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

        return 0;
    }
    public function DrawBD()
    {
        $this->CheckSQL();

        $this->resultMain = $this->conn->query($this->sqlCurrent);

        while ($row = $this->resultMain->fetch_assoc())
        {
            $this->DrawRow($row);
        }
    }

    private function DrawRow($row)
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

    private function CheckSQL()
    {
        $arrayOfFilters = array();
        foreach ($this->currentFilters as $currentF)
        {
            if($currentF != 0 && $currentF != "")
            {
                $key = array_search("$currentF", $this->currentFilters);

                $arrayOfFilters[$key] = $currentF;
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

    private function GetFilterRule($filter)
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
