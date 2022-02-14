<?php
include_once "database.php";

const token = "sdjshssdjhsd54561sd1s6d4sdsd1s2s1sdsdsd4s5ds1d26";

function dbExec($sql , $param_array)
{
    $database = new Database();
    $database->getConnection();
    $myCon =$database->conn;
    $stmt = $myCon->prepare($sql);
    $stmt->execute($param_array);
    return $stmt;
}

function dbExec1($sql)
{
    $database = new Database();
    $database->getConnection();
    $myCon =$database->conn;
    $myCon ->exec($sql);
    $last_id = $myCon->lastInsertId();
    return $last_id;
}

function is_auth()
{
    if (isset($_GET["token"]) && $_GET["token"] == token)
    {
        return true;
    } else {
        return false;
    }
}

?>