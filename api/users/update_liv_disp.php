<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../../library/function.php";



if
(
    isset($_POST["phone"]) 
       
)
{
    //$disp = $_POST["disp"];
    $repas_id = $_POST["phone"];
    $status= $_POST["status"];
    $livraison = $_POST["livraison"];

    
    $selectArray = array();
    //array_push($updateArray, htmlspecialchars(strip_tags($disp)));
    array_push($selectArray, htmlspecialchars(strip_tags($repas_id)));
 


    if($status == 1)
    {
       


        $sql = "update re_pizzeria 
        set status=1 
        where phone=?";
        $result = dbExec($sql, $selectArray);


        
    }else if($status == 0){
        $sql = "update re_pizzeria 
        set status= 0 
        where phone=?";
        $result = dbExec($sql, $selectArray);
        



    }
    
    if( $livraison == 0){
        $sql = "update re_pizzeria 
        set livraison= 0
        where phone = ? ";
        $result = dbExec($sql, $selectArray);
        


        

    }else if( $livraison == 1){
        $sql = "update re_pizzeria 
        set livraison= 1
        where phone = ? ";
        $result = dbExec($sql, $selectArray);
        


    }

    


 
   
    $resJson = array("result" => "success", "code"=> "200" , "message" => "donne");
    
    echo json_encode($resJson, JSON_UNESCAPED_UNICODE);
}else
{
    //bad request
    $resJson = array("result" => "fail", "code"=> "400" , "message" => "error");
    echo json_encode($resJson, JSON_UNESCAPED_UNICODE);

}

?>