<?php

class DataConnection
{
    private $host = "localhost";
    private $user = "482509";
    private $password = "CICT_clm";
    private $dbname = "482509";
    // private $port = 3306;
    // private $socket = "";
    public $con = "";

    function __construct()
    {
        $this->con = new mysqli($this->host, $this->user, $this->password, $this->dbname)
            or die('Could not connect to the database server' . mysqli_connect_error());
    }

    protected function escapeValue($val)
    {
        $value = $this->con->real_escape_string(trim($val));
        if (empty($value)) {
            return false;
        } else {
            return $value;
        }
    }

    //$con->close();

}

// $host = "localhost";
// // $port = 3306;
// // $socket = "";
// $user = "482509";
// $password = "CICT_clm";
// $dbname = "482509";

// $con = new mysqli($host, $user, $password, $dbname)
//     or die('Could not connect to the database server' . mysqli_connect_error());

//$con->close();