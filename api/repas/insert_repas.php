<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once "../../library/function.php";
include_once "../../library/create_image.php";

if (
    isset($_POST["repas_name"])
    && isset($_POST["price"])
    && isset($_POST["description"])

) {
    if (!empty($_FILES["file"]['name']) )

    {
        $images = uploadImage("file" , '../../images/category/' , 200 , 600);
        $img_image = $images["image"];
        $img_thumbnail = $images["thumbnail"];


    }else
    {
        $img_image = "";
        $img_thumbnail = "";
    }
    
    $cat_name = $_POST["repas_name"];
    $cat_name_en = $_POST["price"];
    $description = $_POST["description"];
    $dispp = $_POST["disp"];
    $type = $_POST["id_type"];
    $id_piz = $_POST["id_pizzria"];






    $insertArray = array();
    array_push($insertArray, htmlspecialchars(strip_tags($cat_name)));
    array_push($insertArray, htmlspecialchars(strip_tags($cat_name_en)));
    array_push($insertArray, htmlspecialchars(strip_tags($description)));
    array_push($insertArray, htmlspecialchars(strip_tags($dispp)));

    array_push($insertArray, htmlspecialchars(strip_tags($img_image)));
    array_push($insertArray, htmlspecialchars(strip_tags($img_thumbnail)));
    array_push($insertArray, htmlspecialchars(strip_tags($type)));

////////// 1 er requete
    $sql = "insert into re_repas
        (repas_name , price ,description,disp,cat_image , cat_thumbnail,id_type )
            values(? , ? ,?, ?, ?,?,?)";
    $result = dbExec($sql, $insertArray);

    
    //$resJson = array("result" => "success", "code" => "200", "message" => "done");
    //echo json_encode($resJson, JSON_UNESCAPED_UNICODE);

    $sql = "SELECT id_repas FROM re_repas ORDER BY id_repas DESC LIMIT 1";
    $result = dbExec($sql , []);
    $row = $result->fetch(PDO::FETCH_ASSOC);    
    $my_id= $row["id_repas"];

    $insertArray_2 = array();
    array_push($insertArray_2, htmlspecialchars(strip_tags($my_id)));
    array_push($insertArray_2, htmlspecialchars(strip_tags($id_piz)));
    array_push($insertArray_2, htmlspecialchars(strip_tags($type)));



    $sql = "insert into re_menu
        (id_repas  , id_pizzria ,id_type ) values(? , ? ,?)";
    $result = dbExec($sql, $insertArray_2);

    
    $resJson = array("result" => "success", "code" => "200", "message" => "done");
    echo json_encode($resJson, JSON_UNESCAPED_UNICODE);

    





    
} else {
    //bad request
    $resJson = array("result" => "fail", "code" => "400", "message" => "error");
    echo json_encode($resJson, JSON_UNESCAPED_UNICODE);
}

?>
