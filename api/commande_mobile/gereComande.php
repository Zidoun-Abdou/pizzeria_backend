<?php



header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once "../../library/database.php";

include_once "../../library/function.php";
include_once "../../library/create_image.php";

if (
    isset($_POST["id_repas"])
    && isset($_POST["phone_cuns"])
    && isset($_POST["id_pizzeria"])
    && isset($_POST["num_commande"])

) {
    
    $repas = $_POST["id_repas"];
    $pizzeria = $_POST["id_pizzeria"];
    $client = $_POST["phone_cuns"];
    $num_comnd = $_POST["num_commande"];
    $remarque = $_POST["remarque"];
    $etat  = $_POST["etat"];
    $total   = $_POST["total"];
    $livraison = $_POST["livraison"];



    
    $sql = "insert into re_commande
        (id_repas,id_pizzeria ,phone_cuns,num_commande,remarque,etat,total,livraison)
            values($repas,$pizzeria,$client,$num_comnd,'$remarque',$etat,$total,$livraison)";
    $result2 = dbExec1($sql);
    

 


    $resJson = array("result" => "success", "code" => "200", "message" => $result2);
    echo json_encode($resJson, JSON_UNESCAPED_UNICODE);
} else {
    //bad request
    $resJson = array("result" => "fail", "code" => "400", "message" => "errorfaycal");
    echo json_encode($resJson, JSON_UNESCAPED_UNICODE);
}

?>

