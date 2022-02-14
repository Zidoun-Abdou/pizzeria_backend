<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../../library/function.php";



if
(
    isset($_GET["phone"])
    && is_numeric($_GET["phone"])
    
)
{
    $user_id  = htmlspecialchars(strip_tags($_GET["phone"]));

    $deleteArray = array();
    array_push($deleteArray , $user_id);
    $sql = "Delete from re_customer where phone =? ";
    $result = dbExec($sql, $deleteArray);
    $arrJson = array();

    $resJson = array("result" => "success", "code"=> "200" , "message" => "done");
    
    echo json_encode($resJson, JSON_UNESCAPED_UNICODE);
}else
{
    //bad request
    $resJson = array("result" => "fail", "code"=> "400" , "message" => "error");
    echo json_encode($resJson, JSON_UNESCAPED_UNICODE);

}

?>