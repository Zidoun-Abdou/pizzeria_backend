<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../../library/function.php";


if
(isset($_POST["customer_name"]) && isset($_POST["phone"]))
{
    

    
    
    $user_name = $_POST["customer_name"];
    $user_mobile = $_POST["phone"];
    
    $selectArray = array();
    array_push($selectArray , $user_mobile);
    $sql = "Select * from re_customer where phone=? ";
    $result = dbExec($sql, $selectArray);
    $arrJson = array();
    if($result->rowCount() == 0)
    {
        $insertArray = array();
        array_push($insertArray, htmlspecialchars(strip_tags($user_name)));
        array_push($insertArray, htmlspecialchars(strip_tags($user_mobile)));
  
   
        $sql = "Insert into re_customer(customer_name, phone) values(? ,?)";
 
     
        $result = dbExec($sql, $insertArray);
     
        //$resJson = array("result" => "succes", "code" => "200", "message" => "succes");
        //echo json_encode($resJson,JSON_UNESCAPED_UNICODE);


        $resJson = array("result" => "success", "code"=> "200" , "message" => $user_mobile);
     
     echo json_encode($resJson, JSON_UNESCAPED_UNICODE);
    }
}

?>