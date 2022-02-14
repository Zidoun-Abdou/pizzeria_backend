<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../../library/function.php";

if
(
    isset($_GET["txtsearch"])
    
    
){

    $txtsearch = $_GET["txtsearch"];
    $selectArray = array();
    array_push($selectArray, "%".htmlspecialchars(strip_tags($txtsearch))."%");
 
   
    

    $sql = "Select * from re_pizzeria where pizzeria_name like ? ";
    $result = dbExec($sql, $selectArray);

    $sql2 = "Select address from re_pizzeria where address like ? ";
    $result2 = dbExec($sql2, $selectArray);




    $arrJson = array();
    $arrJson2 = array();

    if($result->rowCount() > 0)
    {
        while ($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            //extract($row);
            $arrJson[] = $row;
        }
    }
    if($result2->rowCount() > 0)
    {
        while ($row = $result2->fetch(PDO::FETCH_ASSOC))
        {
            //extract($row);
            $arrJson2[] = $row;
        }
    }
    $resJson = array("result" => "success", "code"=> "200" , "message" => $arrJson,$arrJson2);
    
    echo json_encode($resJson, JSON_UNESCAPED_UNICODE);
}else
{
    //bad request
    $resJson = array("result" => "fail", "code"=> "400" , "message" => "error");
    echo json_encode($resJson, JSON_UNESCAPED_UNICODE);

}


?>