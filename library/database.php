<?php

class database {
    private $host = "localhost";
    private $db_name = "id17806439_restaurant";
    private $username = "id17806439_softech";
    private $password = "t@~jhx0zR2$}e6te";

    public $conn;

     // get connection

     public function getConnection()
     {
         $this->conn = null;

         try
         {
            //echo"connect"; die()   ;
             $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" .$this->db_name , $this->username ,$this->password);
             //$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             $this->conn->exec("set names utf8mb4");      
             //echo"connect"; die()   ;
        }
        catch(PDOException $exception)
        {
            echo "connection error " . $exception->getMessage();
        }
     }
}

?>