<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../../library/function.php";


if
(   isset($_POST["ingrediant_name"]) && 
    isset($_POST["id_pizz"])  &&
    isset($_POST["id_repas"]) 
)
{
    

    
    
    $ingrd_name = $_POST["ingrediant_name"];
    $id_piz = $_POST["id_pizz"];
    $id_repas =$_POST["id_repas"];
    $price = $_POST["price_ing"];

    
    $selectArray = array();
    array_push($selectArray , $ingrd_name);
    array_push($selectArray , $id_piz);
    array_push($selectArray , $id_repas);

    $sql = "Select * from re_ingrediant where ingrediant_name=? and id_pizz=? and id_repas =?";
    $result = dbExec($sql, $selectArray);
    $arrJson = array();
    if($result->rowCount() == 0)
    {
        $insertArray = array();
        array_push($insertArray, htmlspecialchars(strip_tags($ingrd_name)));
        array_push($insertArray, htmlspecialchars(strip_tags($id_piz)));
        array_push($insertArray, htmlspecialchars(strip_tags($id_repas)));
        array_push($insertArray, htmlspecialchars(strip_tags($price)));
  
   
        $sql = "Insert into re_ingrediant(ingrediant_name,id_pizz,id_repas,ingr_price) values(?,?,?,?) ";
 
     
        $result = dbExec($sql, $insertArray);
     
        //$resJson = array("result" => "succes", "code" => "200", "message" => "succes");
        //echo json_encode($resJson,JSON_UNESCAPED_UNICODE);


        $resJson = array("result" => "success", "code"=> "200" , "message" =>"succes" );
     
     echo json_encode($resJson, JSON_UNESCAPED_UNICODE);
    }else
    {
        //bad request
        $resJson = array("result" => "fail", "code"=> "400" , "message" => "deja exsisté");
        echo json_encode($resJson, JSON_UNESCAPED_UNICODE);
    
    }
}else
{
    //bad request
    $resJson = array("result" => "fail", "code"=> "400" , "message" => "error");
    echo json_encode($resJson, JSON_UNESCAPED_UNICODE);

}

?>