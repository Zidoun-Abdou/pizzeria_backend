<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../../library/function.php";




 
    $txtsearch = $_GET["txtsearch"];
    $txtindic = $_GET["txtindic"];
    $selectArray = array();
    array_push($selectArray, "%".htmlspecialchars(strip_tags($txtsearch))."%");
 
    if(trim($txtsearch) != "" && trim($txtindic) != "" )
    {

        $sql = "Select * from re_repas where repas_name like ? and id_type = $txtindic ";
    	$result = dbExec($sql, $selectArray);
    }else if(trim($txtsearch) != "")
    {
    	$sql = "Select * from re_repas where repas_name like ? order by id_repas desc limit ";
    	$result = dbExec($sql, $selectArray);
    }
    else if(trim($txtindic) != "" ){

        //echo ("indicateur");
        $sql = "Select * from re_repas where id_type = $txtindic";
    	$result = dbExec($sql, []);
    }else
    {
    
        $sql = "Select * from re_repas order by id_repas desc limit ";
    	$result = dbExec($sql, []);

    }
   

   
    $arrJson = array();
    
    if($result->rowCount() > 0)
    {
        while ($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            //extract($row);
            $arrJson[] = $row;
        }
    }
    $resJson = array("result" => "success", "code"=> "200" , "message" => $arrJson);
    
    echo json_encode($resJson, JSON_UNESCAPED_UNICODE);


?>