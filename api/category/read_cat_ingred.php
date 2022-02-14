<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../../library/function.php";


    $txtindic = $_GET["txtindic"];

    $sql = "Select id_type,nom 
    from re_type 
    WHERE id_pizz = $txtindic";
    $result = dbExec($sql, []);
    
    
   
    $arrJson = array();
    if($result->rowCount() > 0)
    {
        while ($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            //extract($row);
            $arrJson[] = $row;
        }
        $resJson = array("result" => "success", "code"=> "200" , "message" => $arrJson);
    
        echo json_encode($resJson, JSON_UNESCAPED_UNICODE);

    }else
   
{
    //bad request
    $resJson = array("result" => "fail", "code"=> "400" , "message" => "error");
    echo json_encode($resJson, JSON_UNESCAPED_UNICODE);

}

?>