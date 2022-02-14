<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../../library/function.php";



if
(
    isset($_GET["num_commande"])
    && isset($_GET["phone_cuns"])
    && isset($_GET["decide"])
    && isset($_GET["id_piz"])
    
)
{
    $phone  = htmlspecialchars(strip_tags($_GET["phone_cuns"]));
    $NumCom  = htmlspecialchars(strip_tags($_GET["num_commande"]));
    $id_piz = htmlspecialchars(strip_tags($_GET["id_piz"]));
    $decide = htmlspecialchars(strip_tags($_GET["decide"]));

    $deleteArray = array();
    array_push($deleteArray , $NumCom);
    array_push($deleteArray , $phone);
    array_push($deleteArray , $id_piz);
    
    if($decide == "yes"){
        $sql = "UPDATE re_commande t1
        SET t1.etat = 1
        WHERE t1.num_commande = ? 
        AND t1.phone_cuns = ?
        AND t1.id_pizzeria=?;";
        $result = dbExec($sql, $deleteArray);
    }else{
        $sql = "UPDATE re_commande t1
    SET t1.etat = 2
    WHERE t1.num_commande = ? 
    AND t1.phone_cuns = ?
    AND t1.id_pizzeria=?;";
    $result = dbExec($sql, $deleteArray);
    }
    
    

    
    
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