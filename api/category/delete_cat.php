<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../../library/function.php";



if
(
    isset($_GET["id_type"])
    && is_numeric($_GET["id_type"])
    
)
{
    $user_id  = htmlspecialchars(strip_tags($_GET["id_type"]));

    $deleteArray = array();
    array_push($deleteArray , $user_id);

    $sql_1=  "SET GLOBAL FOREIGN_KEY_CHECKS=0";
    $result1_1 = dbExec($sql_1, []);
    
    $sql = "DELETE  re_type , re_repas , re_menu
    FROM re_type
    INNER JOIN re_repas ON re_type.id_type= re_repas.id_type
    INNER JOIN re_menu ON re_type.id_type = re_menu.id_type
    WHERE re_type.id_type= ?;
    SET GLOBAL FOREIGN_KEY_CHECKS=1;";
    
    $result = dbExec($sql, $deleteArray);

    $sql_2 = "DELETE  FROM re_type WHERE re_type.id_type=?;";
    $result1_2 = dbExec($sql_2, $deleteArray);

        

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