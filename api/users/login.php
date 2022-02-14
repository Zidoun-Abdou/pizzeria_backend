<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
    
include_once "../../library/function.php";

if (
    isset($_GET["phone"])
    && isset($_GET["password"])
){
    $user_mobile  = htmlspecialchars(strip_tags($_GET["phone"]));
    $user_pwd  = htmlspecialchars(strip_tags($_GET["password"]));

    $selectArray = array();
    array_push($selectArray , $user_mobile);
    array_push($selectArray , $user_pwd);


    $sql = "select * from re_pizzeria where phone =? and password=? ";
    $result = dbExec($sql, $selectArray);

    $arrJson = array();
    if ($result->rowCount() > 0)
    {
      $arrJson = $result->fetch();
        $resJson = array("result" => "succes", "code" => "200", "message" => $arrJson);
        echo json_encode($resJson,JSON_UNESCAPED_UNICODE);
    }else {
        $resJson = array("result" => "fail", "code" => "400", "message" => "error");
        echo json_encode($resJson,JSON_UNESCAPED_UNICODE);

    }
}


?>