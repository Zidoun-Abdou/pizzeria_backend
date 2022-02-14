<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../../library/function.php";



if
(
    isset($_POST["id_repas"]) 
    && isset($_POST["status"])
    && isset($_POST["type"])

   
)
{
    //$disp = $_POST["disp"];
    $repas_id = $_POST["id_repas"];
    $status= $_POST["status"];
    $type = $_POST["type"];
    $type_cat = $_POST["id_type"];
    
    $selectArray = array();
    $selectArray1 = array();
    //array_push($updateArray, htmlspecialchars(strip_tags($disp)));
    array_push($selectArray, htmlspecialchars(strip_tags($repas_id)));
    array_push($selectArray1, htmlspecialchars(strip_tags($type_cat)));


    if($type == "all" && $status == 1)
    {
       


        $sql = "update re_repas 
        set disp=1 
        where id_type=?";
        $result = dbExec($sql, $selectArray1);


        
    }else if($type == "all" && $status == 0){
        $sql = "update re_repas 
        set disp= 0 
        where id_type=?";
        $result = dbExec($sql, $selectArray1);
        



    }else if( $status == 0){
        $sql = "update re_repas 
        set disp= 0
        where id_repas = ? ";
        $result = dbExec($sql, $selectArray);
        


        

    }else if( $status == 1){
        $sql = "update re_repas 
        set disp= 1
        where id_repas = ? ";
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