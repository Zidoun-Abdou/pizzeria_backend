<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../../library/function.php";



if
(
    isset($_POST["id_pizz"]) &&
    isset($_POST["id"]) 
       
)
{
    //$disp = $_POST["disp"];
    $piz_id = $_POST["id_pizz"];
    $id_ing= $_POST["id"];
    $status = $_POST["disp_ing"];
    
    
    
    $selectArray = array();
    //array_push($updateArray, htmlspecialchars(strip_tags($disp)));
    array_push($selectArray, htmlspecialchars(strip_tags($piz_id)));
    array_push($selectArray, htmlspecialchars(strip_tags($id_ing)));


    if($status == 1)
    {
       

        $sql = "update re_ingrediant 
        set disp_ing=1 
        where id_pizz=? and id=? ";
        $result = dbExec($sql, $selectArray);


        
    }else if($status == 0){
        $sql = "update re_ingrediant 
        set disp_ing=0 
        where id_pizz=? and id=? ";
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