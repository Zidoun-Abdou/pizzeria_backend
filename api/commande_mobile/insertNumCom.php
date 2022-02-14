<?php



header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once "../../library/database.php";

include_once "../../library/function.php";
include_once "../../library/create_image.php";




    
$sql = "INSERT INTO re_num_commande VALUES ();
SELECT re_num_commande LAST_INSERT_ID();";
$result2 = dbExec1($sql);
    

 if ($result2 != NULL){
    $resJson = array("result" => "success", "code" => "200", "message" => $result2);
    echo json_encode($resJson, JSON_UNESCAPED_UNICODE);


 }
else {
    //bad request
    $resJson = array("result" => "fail", "code" => "400", "message" => "erreur number commande");
    echo json_encode($resJson, JSON_UNESCAPED_UNICODE);
}

?>

