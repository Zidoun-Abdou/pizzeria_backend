<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../../library/function.php";



if
(
    isset($_POST["id_commande"]) &&
    isset($_POST["id_ingrediant"]) &&
    isset($_POST["name_ingrediant"]) &&
    isset($_POST["price_ingrediant"]) 
       
)
{
    //$disp = $_POST["disp"];
    $id_com = $_POST["id_commande"];
    $id_ing= $_POST["id_ingrediant"];
    $name_ing = $_POST["name_ingrediant"];
    $price_ing = $_POST["price_ingrediant"];
    
    
    
    $selectArray = array();
    //array_push($updateArray, htmlspecialchars(strip_tags($disp)));
    array_push($selectArray, htmlspecialchars(strip_tags($id_com)));
    array_push($selectArray, htmlspecialchars(strip_tags($id_ing)));
    array_push($selectArray, htmlspecialchars(strip_tags($name_ing)));
    array_push($selectArray, htmlspecialchars(strip_tags($price_ing)));



       

    $sql = "insert into re_commande_ingr
    (id_commande ,id_ingrediant,name_ingrediant,price_ingrediant)
        values(?,?,?,?)";

    $result = dbExec($sql, $selectArray);
    $resJson = array("result" => "success", "code"=> "200" , "message" => "donne");
    
    echo json_encode($resJson, JSON_UNESCAPED_UNICODE);
}else
{
    //bad request
    $resJson = array("result" => "fail", "code"=> "400" , "message" => "error");
    echo json_encode($resJson, JSON_UNESCAPED_UNICODE);

}

?>