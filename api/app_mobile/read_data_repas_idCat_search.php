<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../../library/function.php";


if
(
    isset($_GET["id_pizzria"])
    && is_numeric($_GET["id_pizzria"])
    && isset($_GET["disp"])
    && isset($_GET["start"])
    && is_numeric($_GET["start"])
    && isset($_GET["page_size"])
    && is_numeric($_GET["page_size"])
    
)
{
    //echo("dhdhd");
    $dispo = $_GET["disp"];
    $id_piz = $_GET["id_pizzria"];
    $txtsearch = $_GET["txtsearch"];
    $id_cat = $_GET["txtindic"];
    $start = $_GET["start"];
    $page_size = $_GET["page_size"];

    $selectArray = array();
    $selectArray2 = array();

    array_push($selectArray, htmlspecialchars(strip_tags($id_piz)));
    array_push($selectArray2, htmlspecialchars(strip_tags($id_piz)));
    array_push($selectArray2, "%".htmlspecialchars(strip_tags($txtsearch))."%");


    
 
    if(trim($txtsearch) != "" )
    {
    
        $sql = "SELECT re_menu.id_repas,re_repas.*
        FROM re_repas
        INNER JOIN re_menu ON re_repas.id_repas=re_menu.id_repas
        where id_pizzria =? AND disp = $dispo AND re_repas.repas_name like ?
        Limit $start , $page_size ";

    	$result = dbExec($sql, $selectArray2);

    }else if( trim($id_cat) != "")
    {
    	$sql = "Select * from re_repas where  id_type = $id_cat  AND disp = $dispo 
         Limit $start , $page_size ";

    	$result = dbExec($sql, []);

    }else if(trim($id_cat) == "" && trim($txtsearch) == "" )
    {
        //echo('if3');
        $sql = "SELECT re_menu.id_repas,re_repas.*
        FROM re_repas
        INNER JOIN re_menu ON re_repas.id_repas=re_menu.id_repas
        where id_pizzria =?  AND disp = $dispo
        Limit $start , $page_size ";

    	$result = dbExec($sql, $selectArray);

    }
   

   
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