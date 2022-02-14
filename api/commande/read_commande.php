<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../../library/function.php";

if
(

    isset($_GET["txtsearch"])
    
)
{
    $id_pizzeria = $_GET["txtsearch"];
    //$id_commande = $_GET["num_commande"];

    $selectArray = array();
    array_push($selectArray, htmlspecialchars(strip_tags($id_pizzeria)));
    //array_push($selectArray, htmlspecialchars(strip_tags($id_commande)));

 
    
    $sql = "SELECT re_repas.id_repas, re_repas.repas_name,re_repas.price,
    re_commande.remarque, re_commande.etat,re_commande.num_commande,re_commande.phone_cuns,re_commande.livraison,re_commande.id,re_commande.total,
    re_commande_ingr.name_ingrediant,re_commande_ingr.price_ingrediant
        
        FROM re_commande
        JOIN re_repas  ON re_repas.id_repas=re_commande.id_repas
        LEFT JOIN re_commande_ingr  ON re_commande_ingr.id_commande=re_commande.id
        Where id_pizzeria=? and etat=0 order by num_commande;";
    $result = dbExec($sql, $selectArray);



    
    
   
    $arrJson = array();
    
    if($result->rowCount() > 0)
    {
        while ($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            //extract($row);
            $arrJson[] = $row;
        }
    }
    
    $resJson = array("result" => "success", "code"=> "200" , "message" => $arrJson);
    
    echo json_encode($resJson, JSON_UNESCAPED_UNICODE);

}else
{
    //bad request
    $resJson = array("result" => "fail", "code"=> "400" , "message" => "error");
    echo json_encode($resJson, JSON_UNESCAPED_UNICODE);

}


    



?>