<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../../library/function.php";



if
(
    isset($_GET["id_repas"])
    && is_numeric($_GET["id_repas"])
    
)
{
    $repas_id  = htmlspecialchars(strip_tags($_GET["id_repas"]));

    $deleteArray = array();
    array_push($deleteArray , $repas_id);
    
    $sql_1=  "SET GLOBAL FOREIGN_KEY_CHECKS=0";
    $result1_1 = dbExec($sql_1, []);

    
    $sql = "DELETE  re_repas , re_menu
    FROM re_repas
    INNER JOIN re_menu ON re_menu.id_repas= re_repas.id_repas
    WHERE re_repas.id_repas = ?;
    SET GLOBAL FOREIGN_KEY_CHECKS=1;";
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