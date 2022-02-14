<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../../library/function.php";

if
(
    isset($_GET["phone_cuns"])
    
)
{
    $phone_Cuns = $_GET["phone_cuns"];
    //$id_commande = $_GET["num_commande"];

    $selectArray = array();
    //array_push($selectArray, htmlspecialchars(strip_tags($phone_Cuns)));
    //array_push($selectArray, htmlspecialchars(strip_tags($id_commande)))order by id ;
    // nahinaa hdi m requete order by id

 
    
  
    $sql = "SELECT re_pizzeria.pizzeria_name,re_pizzeria.prix_livraison,
    re_repas.repas_name,re_repas.price, 
    re_commande.remarque, re_commande.etat, re_commande.livraison, re_commande.temps,re_commande.num_commande,re_commande.total,re_commande.id,
    re_commande_ingr.name_ingrediant, re_commande_ingr.price_ingrediant, re_commande_ingr.id_ingrediant
    FROM  re_commande
    INNER JOIN re_repas ON re_repas.id_repas=re_commande.id_repas
    INNER JOIN re_pizzeria ON re_commande.id_pizzeria=re_pizzeria.id_pizz
    LEFT JOIN re_commande_ingr ON re_commande.id=re_commande_ingr.id_commande
    Where phone_cuns=$phone_Cuns and temps BETWEEN CURRENT_DATE()-1 and CURRENT_TIMESTAMP() ;";
    $result = dbExec($sql, []);
    



    
    
   
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