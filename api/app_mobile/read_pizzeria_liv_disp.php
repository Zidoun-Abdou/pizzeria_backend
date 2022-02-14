<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../../library/function.php";


if
(
    isset($_GET["type_pizzeria"])
    && isset($_GET["livraison"])
    && isset($_GET["start"])
    && is_numeric($_GET["start"])
    && isset($_GET["end"])
    && is_numeric($_GET["end"])
    && isset($_GET["latitude"])
    && isset($_GET["longitude"])
)
{
    $type_pz = $_GET["type_pizzeria"];
    $livraison = $_GET["livraison"];
    $start = $_GET["start"];
    $end = $_GET["end"];
    $latitude = $_GET["latitude"];
    $longitude = $_GET["longitude"];

    $selectArray = array();
    $selectArray2 = array();
    array_push($selectArray, htmlspecialchars(strip_tags($type_pz)));
    
    if(trim($type_pz) != "" && trim($livraison) == true )

    {

        $sql = "SELECT re_pizzeria.*,
        111.111 * DEGREES(ACOS(LEAST(1.0, COS(RADIANS(re_pizzeria.loc_lat))
         * COS(RADIANS($latitude))
         * COS(RADIANS(re_pizzeria.loc_long - $longitude))
         + SIN(RADIANS(re_pizzeria.loc_lat))
         * SIN(RADIANS($latitude))))) AS distance_in_km


        from re_pizzeria
        INNER JOIN re_type ON re_type.id_pizz=re_pizzeria.id_pizz and re_type.nom=?
        where livraison = 1
        GROUP BY re_pizzeria.pizzeria_name
        order by distance_in_km ASC
        Limit $start , $end";
    	$result = dbExec($sql, $selectArray);

    }else if(trim($type_pz) == "" && trim($livraison) == true){

        $sql = "SELECT re_pizzeria.*,
        111.111 * DEGREES(ACOS(LEAST(1.0, COS(RADIANS(re_pizzeria.loc_lat))
         * COS(RADIANS($latitude))
         * COS(RADIANS(re_pizzeria.loc_long - $longitude))
         + SIN(RADIANS(re_pizzeria.loc_lat))
         * SIN(RADIANS($latitude))))) AS distance_in_km
        from re_pizzeria
        INNER JOIN re_type ON re_type.id_pizz=re_pizzeria.id_pizz 
        where livraison = 1
        GROUP BY re_pizzeria.pizzeria_name
        order by distance_in_km ASC
        Limit $start , $end ";
    	$result = dbExec($sql, []);

    }
    else if(trim($type_pz) == "" && trim($livraison) == false){

        $sql = "SELECT re_pizzeria.*,
        111.111 * DEGREES(ACOS(LEAST(1.0, COS(RADIANS(re_pizzeria.loc_lat))
         * COS(RADIANS($latitude))
         * COS(RADIANS(re_pizzeria.loc_long - $longitude))
         + SIN(RADIANS(re_pizzeria.loc_lat))
         * SIN(RADIANS($latitude))))) AS distance_in_km
        from re_pizzeria
        INNER JOIN re_type ON re_type.id_pizz=re_pizzeria.id_pizz
        GROUP BY re_pizzeria.pizzeria_name
        order by distance_in_km ASC
        Limit $start , $end ";
    	$result = dbExec($sql, []);

    }else if(trim($type_pz) != "" && trim($livraison) == false){

        $sql = "SELECT re_pizzeria.*,
        111.111 * DEGREES(ACOS(LEAST(1.0, COS(RADIANS(re_pizzeria.loc_lat))
         * COS(RADIANS($latitude))
         * COS(RADIANS(re_pizzeria.loc_long - $longitude))
         + SIN(RADIANS(re_pizzeria.loc_lat))
         * SIN(RADIANS($latitude))))) AS distance_in_km
        from re_pizzeria
        INNER JOIN re_type ON re_type.id_pizz=re_pizzeria.id_pizz and re_type.nom=?
        GROUP BY re_pizzeria.pizzeria_name 
        order by distance_in_km ASC
        Limit $start , $end ";
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