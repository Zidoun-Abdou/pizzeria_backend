<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../../library/function.php";



if
(
    isset($_GET["id_pizz"])
    && is_numeric($_GET["id"])
    
)
{
    $ingr_id  = htmlspecialchars(strip_tags($_GET["id"]));
    $id_piz  = htmlspecialchars(strip_tags($_GET["id_pizz"]));


    $deleteArray = array();
    array_push($deleteArray , $ingr_id);
    array_push($deleteArray , $id_piz);

    $sql = "Delete from re_ingrediant where id =? and id_pizz=? ";
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